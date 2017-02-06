<?php 

use yii\helpers\Url;
?>

<div class="list-box">
    <div class="list-title">
        <h3>News</h3>
    </div>
        <ul class="homepage-list news-list">
            <?php foreach ($news as $guide) { 
                $guideImage = cloudinary_url($guide->image_url, array("width" => 105, "height" => 80, "crop" => "fill"));
            ?>
            <li>
                <a href="<?=Url::toRoute($guide->getRoute())?>" title="">
                    <img src="<?= $guideImage ?>" alt="" />
                    <h4 class="small-title"><?= $guide->title ?></h4>
                    <p><?= $guide->shortDescription() ?></p>
                </a>
            </li>
            <?php } ?>
        </ul>
    <a href="<?= Url::toRoute(['/news'])?>" title="More News"><p class="more-link">More News<i class="fa fa-chevron-right" aria-hidden="true"></i></p></a>
</div> 