<?php

namespace backend\controllers\catalog;

use Yii;
use common\models\Category;
use common\models\Company;
use backend\models\CompanySearch;
use common\models\Feature;
use backend\models\FeatureSearch;
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
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
                        'actions' => ['index', 'create','view', 'update', 'delete' ,'detach', 'upload', 'delogo', 'uplogo','addinfo','deleteinfo','position'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'deleteinfo' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $productId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($productId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Company'));
            $post = ['Company' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {        
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {

            $searchModel = new CompanySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchModel = new FeatureSearch();
        $searchModel->company_id = $id;
        $dataProvider = $searchModel->search([]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Detach Company Image  from Company
     * @param integer $id
     * @param integer $imageId
     * @return mixed
     */
    public function actionDelogo($id) {
        $model = $this->findModel($id);
        $output = [];
        \Cloudinary\Uploader::destroy($model->logo_url);
        $model->logo_url = '';
        $model->save();
        echo json_encode($output);
    }

   public function actionUplogo($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_company_logo');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $logo_url = $uploadResult['public_id'];
                $model->logo_url = $logo_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($logo_url, array("width" => 247, "height" => 78, "crop" => "fill")) .'" class="file-preview-image">';

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
     * Detach Company Image  from Company
     * @param integer $id
     * @param integer $imageId
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

        $image = UploadedFile::getInstanceByName('new_company_image');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $image_url = $uploadResult['public_id'];
                $model->image_url = $image_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($image_url, array("width" => 250, "height" => 190, "crop" => "fill")) .'" class="file-preview-image">';

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
     * Add Fields 
     * @return mixed
     */
    
    public function actionAddinfo($id) {

        $brokerModel = $this->findModel($id);
        
        $model = new Feature();
        $model->company_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->company_id]);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_infoform', [
                        'model' => $model
            ]);
        } else {
            return $this->render('_infoform', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Delete Product Info to product
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteinfo($id, $infoId) {
        $model = $this->findModel($id);
        Feature::findOne($infoId)->delete();
        return $this->redirect(['view', 'id' => $model->id]);
    }


    /**
     * Change Self Rank of company
     * @param integer $id
     * @return mixed
     */
    public function actionPosition($id, $type) {
        $model = $this->findModel($id);

        if ($type == 'up') {
            $companies = Company::find()->orderBy(['self_rank' => SORT_ASC])->all();
        } else {
            $companies = Company::find()->orderBy(['self_rank' => SORT_DESC])->all();
        }

        $prevOne = null;
        foreach($companies as $company) {
            if ($company->id == $id) {
                $c = $prevOne->self_rank;
                $prevOne->self_rank = $company->self_rank;
                $company->self_rank = $c;

                $prevOne->save();
                $company->save();

                break;
            } 

            $prevOne = $company;
        }
        return $this->redirect(['index']);

    }


    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        if ($model->load(Yii::$app->request->post()) ) {

            $image = UploadedFile::getInstance($model, 'temp_image');
            if ($image) {

                $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

                if (isset($uploadResult['public_id'])) {
                    $image_url = $uploadResult['public_id'];
                    $model->image_url = $image_url;
                }
            }

            $image_logo = UploadedFile::getInstance($model, 'temp_image_logo');
            if ($image_logo) {

                $uploadResult = \Cloudinary\Uploader::upload($image_logo->tempName);

                if (isset($uploadResult['public_id'])) {
                    $logo_url = $uploadResult['public_id'];
                    $model->logo_url = $logo_url;
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
     * Updates an existing Company model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //Regenerate Order for Company ranking in category
        $cateCompsForCompany = $model->cateComps;

        if ($cateCompsForCompany != null) {
            foreach($cateCompsForCompany as $currModel) {
                $currRank = $currModel->rank;

                $cateComps = $currModel->category->getCateComps()->orderBy(['rank' => SORT_DESC])->all();
                foreach ($cateComps as $cateComp) {
                    if ($cateComp->rank > $currRank) {
                        $cateComp->rank = $cateComp->rank - 1;
                        $cateComp->save();
                    } else {
                        break;
                    }
                }
            }
        }

        //Regenerate Order for Company ranking

        $currRank = $model->self_rank;
        $companies = Company::find()->orderBy(['self_rank' => SORT_DESC])->all();
        foreach ($companies as $company) {
            if ($company->self_rank > $currRank) {
                $company->self_rank = $company->self_rank - 1;
                $company->save();
            } else {
                break;
            }
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
