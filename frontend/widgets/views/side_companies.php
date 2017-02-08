<?php 

use yii\helpers\Url;
?>

<div class="list-box">
    <div class="list-title">
            <h3>Reviews</h3>
        </div>
    <ul class="homepage-list analysis-list">
            <?php foreach ($companies as $company) { 
                $companyImage = cloudinary_url($company->image_url, array("width" => 105, "height" => 80, "crop" => "fill"));
            ?>
            <li>
                <a href="<?=Url::toRoute($company->getRoute())?>" title="">
                    <img src="<?= $companyImage ?>" alt="" />
                    <h4 class="small-title"><?= $company->title ?></h4>
                    <p><?= $company->shortDescription() ?></p>
                </a>
            </li>
            <?php } ?>
        </ul>
    <a href="<?= Url::toRoute(['/review'])?>" title="More Reviews"><p class="more-link">More Reviews<i class="fa fa-chevron-right" aria-hidden="true"></i></p></a>
</div> 