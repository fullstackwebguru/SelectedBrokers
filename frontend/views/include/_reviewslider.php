<?php

use frontend\widgets\Rating;
use kartik\markdown\Markdown;
use yii\helpers\Url;

?>

<div class="container" id="fw-fix">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div id="company-review-carousel" class="carousel slide auto" data-ride="carousel">


  <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">

            <?php
              $compIndex = 0;
              foreach($cateComps as $catComp) {
                  $company = $catComp->company;
                  if ($company->status != 1) {
                      continue;
                  }

                  $compIndex++;
                  $companyImage = cloudinary_url($company->logo_url, array("width" => 135, "height" => 85, "crop" => "fill"));
            ?>

            <div class="item <?= $compIndex == 1 ? 'active' : '' ?>">
              <div class="col-lg-2"><img src="<?= $companyImage ?>" alt="<?= $company->title ?>">
              </div>   
              <div class="col-lg-7">
                <h3><?= $company->title ?></h3>
                <hr>
                <p><?= $company->slider_text ?></p>   
              </div> 
              <div class="col-lg-3 button-block">
                <p class="ammount"><?= $company->bonus_offer ?></p>
                <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="get-deal"> <?= $company->promotion_link_text ?> </a>
                  <a href="<?= Url::toRoute($company->getRoute()) ?>" class="button custom-btn" target="_blank" title="Learn More">Learn More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
              </div>
            </div>

            <?php } ?>
          </div>

          <!-- Left and right controls if needed -->
          <a class="left carousel-control" href="#company-review-carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#company-review-carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a> 
        </div>
           
           
      </div>
           
       
    </div>
  </div>
</div>
    
<div style="margin:30px 0"></div>