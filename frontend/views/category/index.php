<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\Banner;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;


$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

?>

<!-- casinos section-->
<section id="casinos-1">
    <div class="container">
        <h1 class="headlines-2 ">OUR <span class="red "> CATEGORIES</span></h1>

        <?php foreach ($categories as $category) { 
        	$categoryImage = cloudinary_url($category->image_url, array("width" => 377, "height" => 220, "crop" => "fill"));
		?>
        <div class="col-md-4 col-sm-6 padd-left">
            <div class="categ-wrapp">
                <div class="img-categ" style="background-image: url('<?= $categoryImage ?>');">
					<div class="layer">
						<h2 class="categ"><?= $category->short_title ?></h2>
					</div>
                </div>
                <div class="categ-wrapp-2">
                <p class="categ-title "><?= $category->title ?></p>
                <p class="categ-text "><?= $category->short_description ?></p>
                <div class="col-xs-12 ">
                    <a href="<?=Url::toRoute($category->getRoute())?>" class=" btn btn-md btn-danger categ-btn ">LEARN MORE</a>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>