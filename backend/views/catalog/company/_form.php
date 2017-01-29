<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'options' => ['enctype'=>'multipart/form-data']]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter title...']]
    ]
]);

echo $form->field($model, 'temp_image_logo')->widget(
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

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'short_description'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Short description...']]
    ]
]);

echo $form->field($model, 'description')->widget(
    MarkdownEditor::classname(), 
    ['height' => 300, 'encodeLabels' => false]
);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'website_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter website url...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'bonus_as_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Bonnus Offers...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'bonus_offer'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Bonnus Offers...']]
    ]
]);

echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'rating'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter company rating...']
        ],
    ]
]);


echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'telephone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Telephone...']]
    ]
]);

echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'established'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter Year of established...']
        ],
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'regulation'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Regulation...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'spreads_from'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Spread From...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'pairs_offered'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Pair Offered...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[
        'us_allowed'=>[
            'type'=>Form::INPUT_RADIO_LIST,
            'items'=>[true=>'YES', false=>'NO'],
            'options'=>['inline'=>true]
        ],
    ]
]);


echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'max_leverage'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter Max leverage...']
        ],
    ]
]);

echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'min_deposit'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter mindeposit...']
        ],
    ]
]);


echo $form->field($model, 'review')->widget(
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