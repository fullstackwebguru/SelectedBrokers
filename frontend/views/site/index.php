<?php

/* @var $this yii\web\View */

use frontend\widgets\SideNews;
use frontend\widgets\SideCategory;
use frontend\widgets\SideCompany;

use yii\helpers\Url;
use kartik\markdown\Markdown;

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

<!-- Page Content -->
   
    
    <div class="container">
       <div class="row">
        <!-- Top News -->
        <div class="col-lg-6 col-md-6 col-sm-12 " id="homepage-news">

            <?php

            $topGuideIndex = 0;
            foreach ($topGuides as $topGuide) {

                $topGuideIndex++;
                if ($topGuideIndex == 1) {
                    $topGuideImage = cloudinary_url($topGuide->image_url, array("width" => 585, "height" => 325, "crop" => "fill"));
            ?>
            <div class="row top-news">
                <a href="<?=Url::toRoute($topGuide->getRoute())?>" title="">
                    <img src="<?= $topGuideImage?>" alt="" />
                    <div class="top-news-title">
                        <h2><?= $topGuide->title ?></h2>
                    </div>
                </a>
            </div>
                <?php } ?>
            <?php
            if ($topGuideIndex == 2) {
            ?>
            <div class="row">
            <?php }  ?>

            <?php
            if ($topGuideIndex != 1) {
                $topGuideImage = cloudinary_url($topGuide->image_url, array("width" => 123, "height" => 81, "crop" => "fill"));
            ?>
            <div class="snb col-xs-12 col-sm-4">
                <a href="<?=Url::toRoute($topGuide->getRoute())?>" title="Lorem ipsum dolor sit amet, consectetur ">
                    <img src="<?= $topGuideImage?>" alt="" />
                    <p class="small-title"><?= $topGuide->title ?> </p>
                </a>
            </div>

            <?php }  ?>

            <?php } ?> 

            <?php
            if ($topGuideIndex >= 2) {
            ?>
            </div>
            <?php }  ?>
        </div> 
           
        <div class="col-lg-6 col-md-6 col-sm-12" id="homepage-slider">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">


  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
    <?php

            $categoryIndex = 0;
            foreach ($categories as $category) {
                $categoryIndex++;

                $categoryImage = cloudinary_url($category->image_url, array("width" => 555, "height" => 475, "crop" => "fill"));
    ?>

      <div class="item <?= $categoryIndex == 1 ? 'active' : '' ?>">
        <img src="<?= $categoryImage ?>" alt="<?= $category->getSliderHeading() ?>">    
          <div class="slide-content">
              <h3><?= $category->getSliderHeading() ?></h3>
              <p><?= $category->slider_description ?></p>    
              <a href="<?= Url::toRoute($category->getRoute())?>" class="button custom-btn" target="_blank" title="Learn More">Learn More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
          </div>
        </div>

    <?php
        }
    ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
           
           
           </div>
           
       
       </div>
    </div>
    <div style="margin:30px 0"></div>
    <div class="container" id="home-mid">
        <div class="row">
            <div class="col-sm-4">
                <?= SideNews::widget() ?>
            </div>
        
            <div class="col-sm-4">
                <?= SideCompany::widget() ?>
            </div>
            
            <div class="col-sm-4">
                <?= SideCategory::widget() ?>
            </div>
            
        </div>
    
    </div>


<?php
    $this->registerJs('
        $(".carousel").carousel({
            interval: 5000 //changes the speed
        });
    ');

?>