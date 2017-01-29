<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\Banner;
use kartik\markdown\Markdown;


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


<section id="t-10">
    <div class="container">
        <?= Markdown::convert($model->description) ?>
    </div>
</section>