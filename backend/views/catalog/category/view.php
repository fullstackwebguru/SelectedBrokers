<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

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
        'label'=>'Category #',
        'displayOnly'=>true,
    ],
    [
        'attribute'=>'short_title', 
        'value'=>$model->short_title
    ],
    [
        'attribute'=>'title', 
        'value'=>$model->title
    ],
    [
        'attribute'=>'short_description', 
        'value'=>$model->short_description
    ],
    [
        'group'=>true,
        'label'=>'Slider Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'slider_title', 
        'value'=>$model->slider_title,
        'label' => 'Heading( #name# indicates category title)',
    ],
    [
        'attribute'=>'slider_description', 
        'type'=>DetailView::INPUT_TEXTAREA,
        'value'=>$model->slider_description
    ],
    [
        'group'=>true,
        'label'=>'Table Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'table_title', 
        'value'=>$model->table_title,
        'label' => 'Heading( #name# indicates category title)',
    ],
    [
        'attribute'=>'table_risk', 
        'label' => 'Risk Warning',
        'type'=>DetailView::INPUT_TEXTAREA,
        'value'=>$model->table_risk
    ],
    [
        'attribute'=>'table_risk_short', 
        'label' => 'Risk (help in table)',
        'type'=>DetailView::INPUT_TEXTAREA,
        'value'=>$model->table_risk_short
    ],
    [
        'attribute'=>'table_advisor_disclosure', 
        'label' => 'Advisor Disclosure',
        'type'=>DetailView::INPUT_TEXTAREA,
        'value'=>$model->table_advisor_disclosure
    ],
    [
        'attribute'=>'show_deposit',
        'format'=>'raw',
        'value'=>$model->show_deposit ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'attribute'=>'show_regulation',
        'format'=>'raw',
        'value'=>$model->show_regulation ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'group'=>true,
        'label'=>'Backgrund and Heading',
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
        'label'=>'How to choose',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'how_to_choose_title', 
        'value'=>$model->how_to_choose_title,
        'label' => 'Heading( #name# indicates category title)',
    ],
    [
        'attribute'=>'how_to_choose', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->how_to_choose),
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
    // $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '200x150', ['class' => 'file-preview-image']);
    $allImages[] = '<img src="' . cloudinary_url($model->image_url, array("width" => 377, "height" => 220, "crop" => "fill")) .'" class="file-preview-image">';

    $allImageConfig[] =[   
            'caption' => 'Current Image',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['detach', 'id'=>$model->id])
    ];
}

$allBannerImages = [];
$allBannerImageConfig = [];

if ($model->banner_background != 'default') {
    // $allBannerImages[] = Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '200x150', ['class' => 'file-preview-image']);
    $allBannerImages[] = '<img src="' . cloudinary_url($model->banner_background, array("width" => 377, "height" => 220, "crop" => "fill")) .'" class="file-preview-image">';

    $allBannerImageConfig[] =[   
            'caption' => 'Current Image',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['detachbanner', 'id'=>$model->id])
    ];
}


//Company information
//
$viewMsg = 'View Company';
$updateMsg = 'Not applicable';
$deleteMsg = 'Remove Company';

$maxRank = $dataProvider->getTotalCount() - 1;

$gridColumns = [
    [
        'attribute' => 'rank',
        'label' => '#',
        'width' => '50px',
        'vAlign'=>'middle',
        'format' => 'raw',
        'value'=>function ($model, $key, $index, $widget) { 
            return ($model->rank+1);
        }
    ],
    [
        'attribute' => 'company_id',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->title;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'Enabled',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return ($model->company->status == 1);
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            if ($action == 'view') {
                return Url::toRoute(['/catalog/company/view', 'id'=> $model->company_id]);
            } else if ($action == 'delete') {
                return Url::toRoute(['deleteinfo', 'id'=>$model->category->id, 'infoId'=>$model->id]);
            } else if ($action == 'up') {
                return Url::toRoute(['rank', 'id'=>$model->category->id, 'actionId'=>$model->id, 'type' => 'up']);
            } else if ($action == 'down') {
                return Url::toRoute(['rank', 'id'=>$model->category->id, 'actionId'=>$model->id, 'type' => 'down']);
            } else {
                return '';
            }
        },
        'template' => '{up} {down} {view} {delete}',
        'buttons' => [
            'up' => function ($url, $model) {
                if ($model->rank != 0 ) {
                    return '<a class="change-rank" href="'. $url . '" data-rank="'. $model->rank .'" title="" data-toggle="tooltip" data-original-title="Up"><span class="glyphicon glyphicon-arrow-up"></span></a>';
                } else {
                    return '';
                }
            },
            'down' => function ($url, $model) {
                if ($model->rank != ($model->category->getMaxRank() - 1 ) ) {
                    return '<a class="change-rank"  href="'. $url . '" data-rank="'. $model->rank .'" title="" data-toggle="tooltip" data-original-title="Down"><span class="glyphicon glyphicon-arrow-down"></span></a>';
                } else {
                    return '';
                }
            },
        ],
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
        'width' => '110px'
    ],
];



$deleteRegMsg = 'Delete Regulation';

$regulationGridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'regulation_id',
        'label' => 'Regulation',
        'vAlign'=>'middle',
        'width' => '30%',
        'value'=>function ($model, $key, $index, $widget) { 
             return $model->regulation->title;
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'delete') {
                return Url::toRoute(['deleteregulation', 'id'=>$model->category_id, 'regId'=>$model->id]);
            } else {
                return '';
            }
        },
        'deleteOptions'=>['title'=>$deleteRegMsg, 'data-toggle'=>'tooltip'], 
    ],
];


$this->registerJs(
   '$(document).ready(function(){ 
        $(document).on("click", "#reset_companyinfos", function() {
            $.pjax.reload({container:"#companyinfos"});  //Reload GridView
        });

        $(document).pjax("a.change-rank", "#companyinfos");
    });'
);

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
            'heading'=>'Category Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view', 'id'=>$model->id])]
    ]);?>

    </div>

</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border" id>
    <h3 class="box-title">Companies</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'showFooter' => false,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::toRoute(['addinfo', 'id'=>$model->id]), ['title'=>'Add', 'id'=>'add_companyinfos', 'class'=>'showModalButton btn btn-success']) . ' ' .
                Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'reset_companyinfos', 'class'=>'btn btn-default'])
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'companyinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
    <h3 class="box-title">Regulations</h3>

    <?= GridView::widget([
        'dataProvider' => $regulationDataProvider,
        'columns' => $regulationGridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'showFooter' => false,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'add_regulationinfos', 'class'=>'showModalButton btn btn-success', 'value'=>Url::toRoute(['addregulation', 'id'=>$model->id])]) 
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'regulationinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Category Image</h3>

        <?= FileInput::widget([
            'name'=>'new_category_image',
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

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Table Backgorund</h3>

        <?= FileInput::widget([
            'name'=>'new_banner_image',
            'options' => [
                'id' => 'input-911'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  1,
                'initialPreview' => $allBannerImages,
                'initialPreviewConfig' => $allBannerImageConfig,
                'initialPreviewAsData' => false,
                'overwriteInitial' => true,
                'autoReplace' => true,
                'showClose' => false,
                'showBrowse' => true,
                'showRemove' => false,
                'showUpload' => false,
                'previewFileType' => 'image',
                'uploadUrl' => Url::toRoute(['uploadbanner', 'id'=>$model->id]),
            ]
        ]) ?>
    </div>
    </div>
<div>



<?php
    yii\bootstrap\Modal::begin([
        'header' => 'Add Regulation Info',
        'id'=>'addRegulationModal',
        'class' =>'modal',
        'size' => 'modal-md',
    ]);
        echo "<div class='regulationModalContent' id='regulationModalContent'></div>";
    yii\bootstrap\Modal::end();

        //js code:
    $this->registerJs('

        $(document).ready(function(){ 
            $(document).on("click", "#add_regulationinfos", function() {
                $("#addRegulationModal").modal("show")
                    .find("#regulationModalContent")
                    .load($(this).attr("value"));
            });
        });
    ');
?>
