<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

use common\models\Company;
use common\models\Page;

/**
 * Review controller
 */
class ReviewController extends Controller
{
    public $numPerPage = 8;

    public $layout = 'review';

    public function actionIndex() {
        $companyCount = Company::find()->where(['=','status',1])->orderBy('id')->count();
        $companies = Company::find()->where(['=','status',1])->orderBy(['self_rank' => SORT_ASC])->limit($this->numPerPage)->all();
        $model = Page::findOne(['page_id'=>'reviews']);
        $more = $companyCount > $this->numPerPage ? 1 : 0;
        return $this->render('index', [
            'model' => $model,
            'companies' => $companies,
            'more' => $more,
            'startPos' => $this->numPerPage
        ]);
    }

    public function actionGenerate()
    {
        $qs = Yii::$app->request->getQueryParams();
        $startNum = isset($qs['startPos']) ? $qs['startPos'] : 0;

        $companyCount = Company::find()->where(['=','status',1])->orderBy(['self_rank' => SORT_ASC])->count();
        $companies = Company::find()->where(['=','status',1])->orderBy(['self_rank' => SORT_ASC])->limit($this->numPerPage)->offset($startNum)->all();
        $more = $companyCount >$startNum + $this->numPerPage ? 1 : 0;
        return $this->renderPartial('_companyList', [
            'companies' => $companies,
            'more' => $more,
            'startPos' => $startNum + $this->numPerPage
        ]);
    }

    public function actionSlug($slug) 
    {
        $parentPage = Page::findOne(['page_id'=>'reviews']);

        $model = $this->findModelBySlug($slug);
        return $this->render('view', [
            'model' => $model,
            'parentPage' => $parentPage
        ]);   
    }

    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Company::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
