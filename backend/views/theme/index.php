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

$this->title = "Theme Setting";
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$modelAttributes = [
    [
        'group'=>true,
        'label'=>'Main Category',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'category_id',
        'format'=>'raw',
        'value'=>$model->category_id == 1 ? $model->category->title : Html::a($model->category->title,  
                ['catalog/category/view', 'id'=>$model->category_id], 
                ['title'=>'View category detail']),
        'type'=>DetailView::INPUT_SELECT2, 
        'widgetOptions'=>[
            'data'=>ArrayHelper::map($categories, 'id', 'title'), 
            'options' => ['placeholder' => 'Select ...'],
            'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
        ]
    ],
    [
        'group'=>true,
        'label'=>'Main Banner',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'banner_heading', 
        'value'=>$model->banner_heading,
        'type'=>DetailView::INPUT_TEXTAREA
    ],
    [
        'attribute'=>'banner_subheading', 
        'value'=>$model->banner_subheading,
        'type'=>DetailView::INPUT_TEXTAREA
    ],
    [
        'group'=>true,
        'label'=>'Home Page Texts',
        'rowOptions'=>['class'=>'info'],  
    ],
    [
        'attribute'=>'hwork_title1', 
        'value'=>$model->hwork_title1,
    ],
    [
        'attribute'=>'hwork_description1', 
        'value'=>$model->hwork_description1,
    ],
    [
        'attribute'=>'hwork_title2', 
        'value'=>$model->hwork_title2,
    ],
    [
        'attribute'=>'hwork_description2', 
        'value'=>$model->hwork_description2,
    ],
    [
        'attribute'=>'hwork_title3', 
        'value'=>$model->hwork_title3,
    ],
    [
        'attribute'=>'hwork_description3', 
        'value'=>$model->hwork_description3,
    ],
    [
        'attribute'=>'hwork_title4', 
        'value'=>$model->hwork_title4,
    ],
    [
        'attribute'=>'hwork_description4', 
        'value'=>$model->hwork_description4,
    ],
    [
        'group'=>true,
        'label'=>'GET IN TOUCH',
        'rowOptions'=>['class'=>'info'],  
    ],
    [
        'attribute'=>'contact_phone', 
        'value'=>$model->contact_phone,
    ],
    [
        'attribute'=>'contact_address', 
        'value'=>$model->contact_address,
    ],
    [
        'attribute'=>'contact_email', 
        'value'=>$model->contact_email,
    ],
    [
        'attribute'=>'how_to_find_best', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->how_to_find_best),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
    ],
];


//images
$allImages = [];
$allImageConfig = [];

if ($model->banner_image) {
    $allImages[] = '<img src="' . cloudinary_url($model->banner_image, array("width" => 600, "height" => 90, "crop" => "fill")) .'" class="file-preview-image">';

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
        'buttons1' => '{update}',
        'panel'=>[
            'heading'=>'Site Setting',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $modelAttributes,
        'formOptions' => ['action' => Url::toRoute(['index'])]
    ]);?>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Banner Image</h3>

        <?= FileInput::widget([
            'name'=>'new_banner_image',
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
                'uploadUrl' => Url::toRoute(['upload']),
            ]
        ]) ?>
    </div>
    </div>
<div>