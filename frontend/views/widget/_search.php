<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
?>

<div>
  <?php foreach($top10s as $category) { ?>
      <a href="<?= Url::toRoute($category->getRoute())?>" class="media single_ten_products">
        <div class="pull-left">              
        <img src="<?= cloudinary_url($category->image_url, array("width" => 50, "height" => 50, "crop" => "fill")) ?>" class="file-preview-image">
        </div>
        <div>
          <?= Rating::widget(['rating' => $category->rating]) ?>
          <span class="rate_title"><?=$category->num_rating?> ratings</span>
          <?=$category->title?>
        </div>
      </a>
  <?php } ?>
</div>