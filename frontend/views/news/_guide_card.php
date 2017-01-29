
<?php

use yii\helpers\Url;
use frontend\widgets\Rating;

$guideLogo = cloudinary_url($guide->image_url, array("width" => 241, "height" => 158, "crop" => "fill"));
?>

<div class="col-lg-3 col-sm-6 col-xs-12 post">
    <div class="panel panel-default  top-news-item">
    <a href="<?= Url::toRoute($guide->getRoute()) ?>" title="">
        <img src="<?= $guideLogo ?>"/>
        <h3><?= $guide->title ?></h3>
        <p><?= $guide->meta_description ?></p> 
    </a>
    </div>
</div>