<?php

namespace backend\controllers\catalog;

use Yii;
use kartik\grid\EditableColumnAction;
use common\models\Category;
use common\models\CateComp;
use backend\models\CategorySearch;
use backend\models\CateCompSearch;
use backend\models\CompanySearch;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use kartik\detail\DetailView;

use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $layout = 'catalog';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create','view', 'update', 'delete' ,'detach', 'upload','addinfo','deleteinfo','position','rank', 'uploadbanner', 'detachbanner'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'addinfo' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $categoryId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($categoryId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Category'));
            $post = ['Category' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {
            $searchModel = new CategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Detach image from Category
     * @param integer $id
     * @return mixed
     */
    public function actionDetach($id) {
        $model = $this->findModel($id);
        $output = [];
        \Cloudinary\Uploader::destroy($model->image_url);
        $model->image_url = '';
        $model->save();
        echo json_encode($output);
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_category_image');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $image_url = $uploadResult['public_id'];
                $model->image_url = $image_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($image_url, array("width" => 377, "height" => 220, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach', 'id'=>$model->id])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
    }

    /**
     * Detach image from Category
     * @param integer $id
     * @return mixed
     */
    public function actionDetachbanner($id) {
        $model = $this->findModel($id);
        $output = [];

        if ($model->banner_background != 'default') {
            \Cloudinary\Uploader::destroy($model->banner_background);
        }

        $model->banner_background = 'default';
        $model->save();
        echo json_encode($output);
    }

    public function actionUploadbanner($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_banner_image');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $banner_background = $uploadResult['public_id'];
                $model->banner_background = $banner_background;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($banner_background, array("width" => 377, "height" => 220, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach', 'id'=>$model->id])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
    }

    /**
     * Add Company Info to Category
     * @param integer $id
     * @return mixed
     */
    
    public function actionAddinfo($id) 
    {
        $model = $this->findModel($id);

        $currentComps = [];
        if (count($model->cateComps) > 0) {
            foreach ($model->cateComps as $catecomp) {
                $currentComps[] = $catecomp->company_id;
            }
        }
        $searchModel = new CompanySearch();
        $searchModel->excludeCompanies = $currentComps;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post()) {
            $selectedIds = Yii::$app->request->post("companyIds");

            $maxCount = $model->getCateComps()->count();

            foreach($selectedIds as $selectedId) {
                $newModel = new CateComp();
                $newModel->category_id = $id;
                $newModel->company_id = $selectedId;
                $newModel->rank = $maxCount;
                $newModel->save();

                $maxCount++;
            }

            Yii::$app->getSession()->setFlash('success', 'Added companies Successfully');
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('addinfo', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Delete Company Info to category
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteinfo($id, $infoId) {
        $model = $this->findModel($id);
        $currModel = CateComp::findOne($infoId);
        $currRank = $currModel->rank;
        $currModel->delete();

        $cateComps = $model->getCateComps()->orderBy(['rank' => SORT_DESC])->all();
        foreach ($cateComps as $cateComp) {
            if ($cateComp->rank > $currRank) {
                $cateComp->rank = $cateComp->rank - 1;
                $cateComp->save();
            } else {
                break;
            }
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && Yii::$app->request->post('kvdelete')) {
            $this->findModel($id)->delete();

            echo Json::encode([
                'success' => true,
                'messages' => [
                    'kv-detail-info' => 'The category # ' . $id . ' was successfully deleted. ' . 
                        Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Click here', 
                            ['index'], ['class' => 'btn btn-sm btn-info']) . ' to proceed.'
                ]
            ]);
            return;
        }

        $searchModel = new CateCompSearch();
        $searchModel->category_id = $id;
        $dataProvider = $searchModel->search([]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            if (Yii::$app->request->get('viewMode') == 'edit') {
                $viewMode = DetailView::MODE_EDIT;    
            } else {
                $viewMode = DetailView::MODE_VIEW;
            }

            return $this->render('view', [
                'model' => $model,
                'viewMode' => $viewMode,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'temp_image');
            if ($image) {

                $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

                if (isset($uploadResult['public_id'])) {
                    $image_url = $uploadResult['public_id'];
                    $model->image_url = $image_url;
                }
            }

            $model->self_rank = $model->getMaxSelfRank() + 1;
            
            if ($model->save())  {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'viewMode' => DetailView::MODE_EDIT
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $currRank = $model->self_rank;
        $categories = Category::find(['<>', 'id', 1])->orderBy(['self_rank' => SORT_DESC])->all();
        foreach ($categories as $category) {
            if ($category->self_rank > $currRank) {
                $category->self_rank = $category->self_rank - 1;
                $category->save();
            } else {
                break;
            }
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Change Self Rank of category
     * @param integer $id
     * @return mixed
     */
    public function actionPosition($id, $type) {
        $model = $this->findModel($id);

        if ($id == 1) return $this->redirect(['view', 'id' => $model->id]);


        if ($type == 'up') {
            $categories = Category::find(['<>', 'id', 1])->orderBy(['self_rank' => SORT_ASC])->all();
        } else {
            $categories = Category::find(['<>', 'id', 1])->orderBy(['self_rank' => SORT_DESC])->all();
        }

        $prevOne = null;
        foreach($categories as $category) {
            if ($category->id == $id) {
                $c = $prevOne->self_rank;
                $prevOne->self_rank = $category->self_rank;
                $category->self_rank = $c;

                $prevOne->save();
                $category->save();

                break;
            } 

            $prevOne = $category;
        }
        return $this->redirect(['index']);

    }

    /**
     * Change Rank of companies in category
     * @param integer $id
     * @return mixed
     */
    public function actionRank($id, $actionId, $type) {
        $model = $this->findModel($id);
        if ($type == 'up') {
            $cateComps = $model->getCateComps()->orderBy(['rank' => SORT_ASC])->all();
        } else {
            $cateComps = $model->getCateComps()->orderBy(['rank' => SORT_DESC])->all();
        }
        

        $prevOne = null;
        foreach($cateComps as $cateComp) {
            if ($cateComp->id == $actionId) {
                $c = $prevOne->rank;
                $prevOne->rank = $cateComp->rank;
                $cateComp->rank = $c;

                $prevOne->save();
                $cateComp->save();

                break;
            } 

            $prevOne = $cateComp;
        }
        return $this->redirect(['view', 'id' => $model->id]);

    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

