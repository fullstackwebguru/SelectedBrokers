
<?php

use yii\helpers\Url;
use frontend\widgets\Rating;

$brokerLogo = cloudinary_url($broker->image_url, array("width" => 241, "height" => 158, "crop" => "fill"));
?>

<div class="col-lg-3 col-sm-6 col-xs-12 post">
    <div class="panel panel-default  top-news-item">
    <a href="<?= Url::toRoute($broker->getRoute()) ?>" title="">
        <img src="<?= $brokerLogo ?>"/>
        <h3><?= $broker->title ?></h3>
        <p><?= $broker->short_description ?></p> 
    </a>
    </div>
</div>