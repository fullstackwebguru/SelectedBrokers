<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\markdown\Markdown;
use frontend\widgets\Rating;
use frontend\widgets\SideCategory;
use frontend\widgets\SideTop5;
use frontend\widgets\Banner;

$this->title = 'Casino -' . $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

$companyLogo = cloudinary_url($model->logo_url);
$companyImage = cloudinary_url($model->image_url, array("width" => 440, "height" => 329, "crop" => "fill"));

?>

<!-- Page Content -->
   
    
<div class="container">
   <div class="row">
       <div class="col-lg-12">
       <ol class="breadcrumb">
            <li><?=  Html::a('Home',['/']) ?></li>
            <li> <?=  Html::a('Reviews',['/review']) ?></li>
            <li class="active"><?= $model->title ?></li>
        </ol>
       </div>
       <div class="col-lg-12">
        <div class="panel article-content">   
        <div class="row">
        <div class="col-lg-5 col-sm-12">
                <img src="<?= $companyImage ?>" class="full-w-image" alt="Company"/>
       </div>
       <div class="col-lg-7 col-sm-12">
           <div class="company-review-title">
            <h2><?= $model->title ?></h2>
            <hr>  
           </div>
           <div class="company-info">
               <ul class="info-list">
                                      <li><span class="greenspan">Telephone:</span> <?= $model->telephone ?></li>
                   <li><span class="greenspan">Established:</span> <?= $model->established ?></li>
                   <li><span class="greenspan">Regulation:</span> <?= $model->regulation ?></li>
               </ul>
               <ul class="info-list">
                <li><span class="greenspan">Min Initial Deposit:</span> £<?= $model->min_deposit ?></li>

<li><span class="greenspan">Max Leverage:</span> <?= $model->max_leverage ?></li>

<li><span class="greenspan">Spreads From (EUR/USD):</span><?= $model->spreads_from ?> pips</li>

<li><span class="greenspan">Pairs Offered:</span> <?= $model->pairs_offered ?></li>

<li><span class="greenspan">U.S. Clients Allowed:</span> <?= $model->us_allowed ? 'YES' : 'NO' ?></li>
                 
               </ul>

            </div>
           <span class="company-links">
                    <p class="ammount"><?= $model->getBonusLinkHeading() ?></p>
                    <a href="<?= $model->website_url ?>" onclick="trackOutboundLink('<?= $model->title ?>', '<?= $model->website_url ?>'); return false;" class="button custom-btn" target="_blank" title="Visit Site"><?= $model->button_text ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
           </span>
                      

       </div>
            
            <div class="col-lg-12">
               
            </div>
            <div class="col-lg-12 company-review-content">
            <h3>Review</h3>
                <hr>
                    <?= Markdown::convert($model->review) ?>
                <hr>
            </div>
            <div class="col-lg-6 col-sm-12 bottom-info">
                <h2><?= $model->title ?></h2>
                <img src="<?= $companyLogo ?>" alt="Company" />
            
            </div>
            <div class="col-lg-6 col-sm-12 bottom-bonus">
                <div class="company-links">
                    
                    <p class="ammount"><?= $model->getBonusLinkHeading() ?></p>
                    <a href="<?= $model->website_url ?>" onclick="trackOutboundLink('<?= $model->title ?>', '<?= $model->website_url ?>'); return false;" class="button custom-btn" target="_blank" title="Visit Site"><?= $model->button_text ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  
                </div>
            </div>
            
           </div> 
           </div>
      </div> 
   </div>
</div>
<div style="margin:30px 0"></div>