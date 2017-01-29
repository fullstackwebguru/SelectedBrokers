<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

$viewMsg = 'View Category Details';
$updateMsg = 'Update Category Details';
$deleteMsg = 'Delte Category';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    // [
    //     'class' => 'kartik\grid\EditableColumn',
    //     'attribute' => 'username',
    //     'pageSummary' => 'Page Total',
    //     'vAlign'=>'middle',
    //     'headerOptions'=>['class'=>'kv-sticky-column'],
    //     'contentOptions'=>['class'=>'kv-sticky-column'],
    //     'editableOptions'=>['header'=>'UserName']
    // ],
    [
        'attribute'=>'username', 
        'vAlign'=>'middle',
    ],
    [
        'attribute'=>'email', 
        'vAlign'=>'middle',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'update') {
                return Url::toRoute(['view', 'id'=>$key, 'viewMode'=>'edit']);     
            } else {
                return Url::toRoute([$action, 'id'=>$key]);
            }
        },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

?>

<div class="row">
    <div class="col-xs-12">
    <!-- <div class="box">
    <div class="box-body"> -->

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
    <!-- </div>
    </div> -->
    </div>
</div>
