<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

use common\models\Guide;
use common\models\Page;

/**
 * Guide controller
 */
class NewsController extends Controller
{

    public $layout = 'review';

    public $numPerPage = 8;

    public function actionIndex() {

        $guideCount = Guide::find()->orderBy('id')->count();
        $guides = Guide::find()->orderBy(['self_rank' => SORT_ASC])->limit($this->numPerPage)->all();
        $model = Page::findOne(['page_id'=>'news']);
        $more = $guideCount > $this->numPerPage ? 1 : 0;
        return $this->render('index', [
            'model' => $model,
            'guides' => $guides,
            'more' => $more,
            'startPos' => $this->numPerPage
        ]);
    }

    public function actionGenerate()
    {
        $qs = Yii::$app->request->getQueryParams();
        $startNum = isset($qs['startPos']) ? $qs['startPos'] : 0;

        $guideCount = Guide::find()->orderBy(['self_rank' => SORT_ASC])->count();
        $guides = Guide::find()->orderBy(['self_rank' => SORT_ASC])->limit($this->numPerPage)->offset($startNum)->all();
        $more = $guideCount >$startNum + $this->numPerPage ? 1 : 0;
        return $this->renderPartial('_newsList', [
            'guides' => $guides,
            'more' => $more,
            'startPos' => $startNum + $this->numPerPage
        ]);
    }

    public function actionSlug($slug) 
    {
        $model = $this->findModelBySlug($slug);
        return $this->render('view', [
            'model' => $model
        ]);   
    }

    /**
     * Finds the Guide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Guide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Guide::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
