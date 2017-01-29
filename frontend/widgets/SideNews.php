<?php

namespace frontend\widgets;

use common\models\Guide;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class SideNews extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $num;

    /**
     * @var array the options for rendering 
     */
    private $news;

    public function init()
    {
        parent::init();

        if ($this->num === null) {
            $this->num = 4;
        }

        $this->news = Guide::find()->orderBy(['self_rank' => SORT_ASC])->limit($this->num)->all();
    }

    public function run()
    {
        return $this->render('side_news', ['news' => $this->news]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
