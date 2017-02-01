<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Top10JsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/jBox.css',
        'css/bootstrap-select.min.css'
    ];

    public $js = [
        'js/jBox.min.js',
        'js/bootstrap-select.min.js',
        'js/category.js'
    ];
    
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
