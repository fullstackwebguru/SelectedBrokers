<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Rating;
use frontend\widgets\Banner;

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
    <div class="row" id="lazy-reviews-container"> 
        <div class="col-lg-12">
            <h2>All Reviews</h2>
        </div>

        <?=  $this->render('_companyList', [
            'companies' => $companies,
            'more' => $more,
            'startPos' => $startPos
        ]); ?>

    </div>
</div>