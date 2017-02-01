<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Category;
use common\models\Page;

/**
 * Category controllers
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $categories = Category::find()->orderBy(['self_rank' => SORT_ASC])->all();
        $model = Page::findOne(['page_id'=>'categories']);
        return $this->render('index', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionSlug($slug) 
    {
        $category = $this->findModelBySlug($slug);
        $parentPage = Page::findOne(['page_id'=>'categories']);

        $queryParams = Yii::$app->request->queryParams;
        $filterSelected = isset($queryParams['filter']) ? $queryParams['filter'] : '';

        if ($filterSelected) {
            $cateComps = $category->getCateCompsSortByRank(['=', 'regulation_id', $filterSelected]);
        } else {
            $cateComps = $category->getCateCompsNoFilterSorByRank();
        }

        return $this->render('view', [
            'category' => $category,
            'cateComps' => $cateComps,
            'parentPage' => $parentPage,
            'filterSelected' => $filterSelected
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Category::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
