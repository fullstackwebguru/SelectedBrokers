<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Theme;

class HowWeWork extends \yii\base\Widget
{
    /**
     * @var array the options for rendering 
     */
    private $mainTheme;

    public function init()
    {
        parent::init();

        if (($models = Theme::find()->all()) !== null && count($models) > 0)  {
            $this->mainTheme = $models[0];
        } else {
            throw new NotFoundHttpException('The requested theme does not exist.');
        }
    }

    public function run()
    {        
        return $this->render('how_we_work', ['theme' => $this->mainTheme]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
