<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Add Companies to Category';
$this->params['breadcrumbs'][] = $this->title;

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
        'attribute' => 'title',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'status', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
    'class'=>'kartik\grid\CheckboxColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
    ],
];

$selectionLimit = 10 - count($model->cateComps);

?>

<div id="ajax-error-container">
</div>
<div class="row">
    <div class="col-xs-12">

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
            'type' => GridView::TYPE_PRIMARY,
            'after'=>Html::a('<i class="glyphicon glyphicon-back"></i> Go to Category', ['view', 'id' => $model->id],  ['class' => 'btn btn-info']) . '  '. Html::button('<i class="glyphicon glyphicon-plus"></i> Add', ['class' => 'btn btn-info', 'id' => 'addToCategory']),
            'before' => 'You can select maximum ' . $selectionLimit . ' companies'
        ],
        'options' => ['id' => 'company-pjax'],
]);?>

    </div>
</div>

<?= Html::beginForm(Url::current(), 'post', ['id' => 'addCompanyForm', 'name' => 'addCompanyForm']) ?>
<?= Html::endForm() ?>

<?php 
    $this->registerJs(' 

    $(document).ready(function(){
        $(document).on("click", "#addToCategory", function(){
            var selectionLimit = parseInt("' . $selectionLimit . '");
            $(\'#addCompanyForm input[name^=companyIds]\').remove();
            var selectedIds = $(\'#company-pjax\').yiiGridView(\'getSelectedRows\');
            if (selectedIds && selectedIds.length > 0)  {
                if (selectedIds.length > selectionLimit) {
                    $("#ajax-error-container").append(\'<div id="ajax-error" class="alert-danger alert fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-ban"></i>You selected more than \' + selectionLimit + \'</div>\');
                    return;
                }
                selectedIds.forEach(function(element) {
                    $(\'#addCompanyForm\').append(\'<input type="hidden" name="companyIds[]" value="\' + element + \'">\');
                });
                $(\'#addCompanyForm\').submit();
            } 
        });
            
    });', \yii\web\View::POS_READY);

?>
