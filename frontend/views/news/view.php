<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
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

$guideImage = cloudinary_url($model->image_url, array("width" => 622, "height" => 388, "crop" => "fill"));
?>

<div class="container">
   <div class="row">
       <div class="col-lg-12">
       <ol class="breadcrumb">
            <li><?=  Html::a('Home',['/']) ?></li>
            <li> <?=  Html::a('News',['/news']) ?></li>
            <li class="active"><?= $model->title ?></li>
        </ol>
       </div>
       <div class="col-lg-12">
        <div class="panel article-content">   
        <h2><?= $model->title ?></h2>
        <hr>
        <img class="mreset" src="<?= $guideImage ?>" style="float: left; margin: 0 20px 20px 0;"/><?= Markdown::convert($model->description) ?>
            </div>
      </div> 
   </div>
</div>
<div style="margin:30px 0"></div>