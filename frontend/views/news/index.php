<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Banner;
use frontend\widgets\SideCategory;
use frontend\widgets\SideTop5;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

?>

<div class="container">
    <div class="row" id="lazy-news-container"> 

        <div class="col-lg-12">
           <h2>All Articles</h2>
        </div>
        

        <?=  $this->render('_newsList', [
            'guides' => $guides,
            'more' => $more,
            'startPos' => $startPos
        ]); ?>

    </div>
</div>