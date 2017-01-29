<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    [
        'group'=>true,
        'label'=>'Basic Details',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'id', 
        'label'=>'Page #',
        'displayOnly'=>true,
    ],
    [
        'attribute'=>'title', 
        'value'=>$model->title
    ],
    [
        'group'=>true,
        'label'=>'SEO Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'slug', 
        'value'=>$model->slug
    ],
    [
        'attribute'=>'meta_keywords', 
        'value'=>$model->meta_keywords
    ],
    [
        'attribute'=>'meta_description', 
        'value'=>$model->meta_description
    ]
];

?>

<div class="row">
    <div class="col-xs-12">

    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'buttons1' => '{update}',
        'panel'=>[
            'heading'=>'Page Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['home'])]
    ]);?>

    </div>

</div>