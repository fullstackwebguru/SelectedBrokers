<?php

namespace frontend\widgets\assets;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SearchBoxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/top10Search.js',
    ];
    
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
