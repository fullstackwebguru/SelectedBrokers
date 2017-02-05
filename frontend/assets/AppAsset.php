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
        'css/bootstrap-sortable.css'
    ];
    public $js = [
        'js/jquery.js',
        'js/bootstrap.js',
        'js/bootstrap-sortable.js',
        'js/highcharts.js',
        'js/review.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
