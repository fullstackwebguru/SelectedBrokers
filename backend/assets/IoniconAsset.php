<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IoniconAsset extends AssetBundle
{
    public $sourcePath = '@vendor/driftyco/ionicons';
    public $css = [
        'css/ionicons.min.css',
    ];

    /**
     * Initializes the bundle.
     * Set publish options to copy only necessary files (in this case css and font folders)
     * @codeCoverageIgnore
     */
    public function init()
    {
        parent::init();

        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            return preg_match('%(/|\\\\)(fonts|css)%', $from);
        };
    }
}
