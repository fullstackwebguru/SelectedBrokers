<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/custom.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/bootstrap.js',
        'js/review.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
