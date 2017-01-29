<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Page;
use common\models\Theme;
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
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
                        'actions' => ['home','view', 'delete' ,'detach', 'upload'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST']
                ],
            ],
        ];
    }

    public function actionHome()
    {
        $model = $this->findModel('home');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('home', [
                'model' => $model
            ]);
        } else {
            return $this->render('home', [
                'model' => $model
            ]);
        }
    }
   
    public function actionView($id, $type) {
        $model = $this->findModel($id);

        if ($type == 1) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->render('view', [
                    'model' => $model
                ]);
            } else {
                return $this->render('view', [
                    'model' => $model
                ]);
            }    
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->render('index', [
                    'model' => $model
                ]);
            } else {
                return $this->render('index', [
                    'model' => $model
                ]);
            }
        }
    }
    

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne(['page_id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMainTheme()
    {
        if (($models = Theme::find()->all()) !== null && count($models) > 0)  {
            return $models[0];
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
