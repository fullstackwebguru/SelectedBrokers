<?php

namespace backend\controllers;

use Yii;
use common\models\Regulation;
use backend\models\RegulationSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * RegulationController implements the CRUD actions for Page model.
 */
class RegulationController extends Controller
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
                        'actions' => ['index','addinfo','deleteinfo'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $fieldId = Yii::$app->request->post('editableKey');
            $model = Regulation::findOne($fieldId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Regulation'));
            $post = ['Regulation' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {
            $searchModel = new RegulationSearch();
            $dataProvider = $searchModel->search([]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);    
        }
        
    }

    /**
     * Add Fields 
     * @return mixed
     */
    
    public function actionAddinfo() {

        $model = new Regulation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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
    public function actionDeleteinfo($id) {
        $model = Regulation::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
