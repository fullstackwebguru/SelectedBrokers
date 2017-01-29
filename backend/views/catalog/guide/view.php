<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    [
        'group'=>true,
        'label'=>'Basic Details',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'id', 
        'label'=>'Product #',
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


//images
$allImages = [];
$allImageConfig = [];

if ($model->image_url) {
    $allImages[] = '<img src="' . cloudinary_url($model->image_url, array("width" => 232, "height" => 236, "crop" => "fill")) .'" class="file-preview-image">';

    $allImageConfig[] =[   
            'caption' => 'Current Image',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['detach', 'id'=>$model->id])
    ];
}

?>

<div class="row">
    <div class="col-xs-12">

    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>$viewMode,
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'panel'=>[
            'heading'=>'Product Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view', 'id'=>$model->id])]
    ]);?>

    </div>
</div>


<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Guide Image</h3>

        <?= FileInput::widget([
            'name'=>'new_guide_image',
            'options' => [
                'id' => 'input-888'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  1,
                'initialPreview' => $allImages,
                'initialPreviewConfig' => $allImageConfig,
                'initialPreviewAsData' => false,
                'overwriteInitial' => true,
                'autoReplace' => true,
                'showClose' => false,
                'showBrowse' => true,
                'showRemove' => false,
                'showUpload' => false,
                'previewFileType' => 'image',
                'uploadUrl' => Url::toRoute(['upload', 'id'=>$model->id]),
            ]
        ]) ?>
    </div>
    </div>
<div>