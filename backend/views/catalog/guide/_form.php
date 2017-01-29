<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


$form = ActiveForm::begin([
    'type'=>ActiveForm::TYPE_VERTICAL,
    'options' => ['enctype'=>'multipart/form-data']
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter title...']]
    ]
]);

echo $form->field($model, 'temp_image')->widget(
    FileInput::classname(), 
    [  
        'options' => [
            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'showUpload' => false,
        ]
    ]
);

echo $form->field($model, 'description')->widget(
    MarkdownEditor::classname(), 
    ['height' => 300, 'encodeLabels' => false]
);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_description'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter description for SEO...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_keywords'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter keywords for SEO...']]
    ]
]);
   
echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'actions'=>[
            'type'=>Form::INPUT_RAW, 
            'value'=>'<div style="text-align: right; margin-top: 20px">' . 
                Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                Html::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) . 
                '</div>'
        ],
    ]
]);
ActiveForm::end();
?>