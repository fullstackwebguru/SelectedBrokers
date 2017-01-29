<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use common\models\Category;
use common\models\Newsletter;
use frontend\models\CategorySearch;


/**
 * Site controller
 */
class WidgetController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'newsletter' => ['POST'],
                    'search' => ['POST', 'GET']
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        $query = Yii::$app->request->get();
        $searchModel = new CategorySearch($query);
        $top10s = $searchModel->search([])->getModels();

        $top10Results = [];

        foreach ($top10s as $top10) {
            // $top10Results['suggestions'][] = [
            //     'value' => $top10->id,
            //     'data' => [
            //         'icon' => cloudinary_url($top10->image_url, array("width" => 359, "height" => 280, "crop" => "fill")),
            //         'url' => Url::toRoute($top10->getRoute()),
            //         'title' => $top10->title,
            //         'id' => $top10->id
            //     ]
            // ];
            // 
            
            $top10Results[] = [
                'value' => $top10->title,
                'icon' => cloudinary_url($top10->image_url, array("width" => 359, "height" => 280, "crop" => "fill")),
                'url' => Url::toRoute($top10->getRoute()),
                'id' => $top10->id
            ];
            
        };

        echo json_encode($top10Results);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionNewsletter()
    { 
        $model = new Newsletter();
        $request = Yii::$app->request;
        if ($request->post('tw_newsletter_side') || $request->post('tw_newsletter_footer')) {
            
            $model->email =  $request->post('tw_newsletter_footer') ? $request->post('tw_newsletter_footer') : $request->post('tw_newsletter_side');

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Thank you. Now ' . $model->email .' is part of our campaign list.');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, We can\'t process this request');
            }    
        } else {

        }
        
        return $this->goBack();
    }
}
