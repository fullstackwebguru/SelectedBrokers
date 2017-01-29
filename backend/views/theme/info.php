<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;


$this->title = "Additional Fields Setting";
$this->params['breadcrumbs'][] = ['label' => 'Fields Setting', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//field additional information
//
$viewMsg = 'Not applicable';
$updateMsg = 'Not applicable';
$deleteMsg = 'Delete field information';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'title',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Title']
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'delete') {
                return Url::toRoute(['deleteinfo', 'id'=>$model->id]);
            } else {
                return '';
            }
        },
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

?>


<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">

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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'add_fieldinfos', 'class'=>'showModalButton btn btn-success', 'value'=>Url::toRoute(['addinfo'])]) 
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'fieldinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>



<?php
    yii\bootstrap\Modal::begin([
        'header' => 'Add Field Info',
        'id'=>'addFieldInfoModal',
        'class' =>'modal',
        'size' => 'modal-md',
    ]);
        echo "<div class='modalContent' id='modalContent'></div>";
    yii\bootstrap\Modal::end();

        //js code:
    $this->registerJs('

        $(document).ready(function(){ 
            $(document).on("click", "#add_fieldinfos", function() {
                $("#addFieldInfoModal").modal("show")
                    .find("#modalContent")
                    .load($(this).attr("value"));
            });
        });
    ');
?>
