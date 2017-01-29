<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/app.css',
        'css/AdminLTE.min.css',
    ];
    public $js = [
        'js/app.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\IoniconAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    public $skin = 'skin-black';

    /**
     * @inheritdoc
     */
    public function init()
    {
        Yii::trace(' Skin  -> ' . $this->skin);
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }
}
