<?php

namespace frontend\widgets;

use Yii;

class Rating extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $ratesTemplate = [
        'default' => [
            'filled' => '<i class="glyphicon glyphicon-star"></i>',
            'half' => '<i class="glyphicon glyphicon-star half"></i>',
            'unfilled'  => '<i class="glyphicon glyphicon-star empty"></i>',
            'class1' => 'score',
            'class2' => 'rating',
        ]
    ];

    /**
     * @var array the options for rendering 
     */
    public $rating;
    public $type;
    public $max_rating;
    public $min_rating;
    public $num_stars;


    public $link_url;
    public $show_review;

    public function init()
    {
        parent::init();

        if ($this->rating === null) {
            $this->rating = 0;
        }

        if ($this->max_rating === null) {
            $this->max_rating = 10;
        }

        if ($this->min_rating === null) {
            $this->min_rating = 0;
        }

        if ($this->num_stars === null) {
            $this->num_stars = 5;
        }

        if ($this->type == null) {
            $this->type = "default";
        }

        if ($this->link_url == null) {
            $this->link_url = "javascript:void(0)";
        }

        if ($this->show_review == null) {
            $this->show_review = 0;
        }
    }

    public function run()
    {
        $currRating = min($this->rating, $this->max_rating);

        $interval = ($this->max_rating - $this->min_rating) / $this->num_stars;
        $value = floor($currRating / $interval);

        $halfFlag = false;

        $offset = $currRating - $value * $interval;
        if ($offset >= $interval*3/4) {
            $value = $value + 1;
        } else if ($offset >= $interval/4) {
            $halfFlag = true;
        }

        $html = '';
        
        $html .= '<p class="' . $this->ratesTemplate[$this->type]['class1'] . '"><a href="' . $this->link_url . '">' . $this->rating . '</a></p>';
        $html .= '<div class="' . $this->ratesTemplate[$this->type]['class2'] . '">';

        for ($i=0; $i< $value; $i++) {
            $html .= $this->ratesTemplate[$this->type]['filled'];
        }

        if ($halfFlag) {
            $html .= $this->ratesTemplate[$this->type]['half'];
            $i++;
        }

        for (; $i < $this->num_stars; $i++) {
            $html .= $this->ratesTemplate[$this->type]['unfilled'];
        }

        $html .= '</div>';

        return $html;
    }
}
