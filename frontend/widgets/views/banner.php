<?php

use yii\helpers\Url;
use kartik\markdown\Markdown;
use yii\helpers\Html;

?>

<!-- top banner-->
<section id="top-hp">
    <div class="container">
        <ul class="icon-menu">
            <?php foreach ($categories as $category) {
                $banner_icon = ($category->banner_icon != null && $category->banner_icon != '/images/icons-01-b.png' && $category->banner_icon != '')  ? cloudinary_url($category->banner_icon , array("width" => 80, "height" => 80, "crop" => "fill")) : "/images/icons-01-b.png";
            ?>
            
            <li class="top-banner">
                <a href="<?= Url::toRoute($category->getRoute())?>">
                    <img src="<?= $banner_icon ?>" class="img-responsive menu-icons icon1-b invert-normal" alt="icons" />
                    <p class="i-text-1"><?= $category->title ?></p>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
            <p class="banner-text-3-hp">
                <?= $mainCategory->banner_heading ?>
                <span><a class=" read-more">Read More</a></span>
            </p>
            <p class="lazy">
                <?= $mainCategory->banner_subheading ?>
            </p>

    </div>
</section>