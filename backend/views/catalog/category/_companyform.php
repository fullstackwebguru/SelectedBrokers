<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute'=>'logo_url', 
        'vAlign'=>'middle',
        'width'=>'80px',
        'format' => 'raw',
        'value'=>function ($model, $key, $index, $widget) { 
            // return Yii::$app->imageCache->img('@mainUpload/' . $model->logo_url, '80x80', ['class' => 'file-preview-image']);
            return '<img src="' . cloudinary_url($model->logo_url, array("width" => 80, "height" => 80, "crop" => "fill")) .'" class="file-preview-image">';
        },
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'title',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Title']
    ],
    ],
    [
    'class'=>'kartik\grid\CheckboxColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
    ],
];
?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);?>