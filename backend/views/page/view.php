<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


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
        'attribute'=>'description', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->description),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
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
        'panel'=>[
            'heading'=>'Page Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view','id'=>$model->page_id, 'type' => 1])]
    ]);?>

    </div>

</div>
