<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
use kartik\markdown\Markdown;

use frontend\assets\Top10JsAsset;

$this->title = 'Category - '. $category->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $category->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $category->meta_description
        ]);

Top10JsAsset::register($this);


$backgroundImage = $category->banner_background == 'default' ? '' : cloudinary_url($category->banner_background, array("width" => 1560, "height" => 233, "crop" => "fill"));

?>

<!-- Page Content -->
   
    
       <div class="row" id="forex-header" <?= $backgroundImage ? 'style="background-image: url('. $backgroundImage .');"' : ''?>>
           <div class="container">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $category->getTableHeading() ?></h1>
            </div>
               </div>
        </div>
    
    
    
       <div class="row">
            <div class="container" id="toplist-table">
                <div class="col-lg-12">
                
                <p><?= $category->banner_heading ?> </p>
                <?php if ($category->banner_subheading)  { ?>
                <p id="category-readmore" class="read-more">read more ...</p>
                <p id="category-subheading" style="display: none;"><?= $category->banner_subheading ?></p>
                <?php } ?>

                <div class="clearfix"> </div>

                <?php 
                if (count($category->regulCates) > 0) {
                ?>

                 <div class="table-filters">
                    <span class="filter-info"><i class="fa fa-filter" aria-hidden="true"></i>Filter by regulations</span>
                    <select id="reg-filter" class="selectpicker">
                      <option value="0" <?= !$filterSelected ? 'selected' : '' ?> >None</option>
                      <?php foreach($category->regulCates as $regulCate) { ?>
                      <option <?= $filterSelected == $regulCate->regulation_id ? 'selected' : '' ?> value="<?=$regulCate->regulation_id ?>"><?= $regulCate->regulation->title ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <?php } ?>
                    
<?= $this->render('../include/_table', [
    'category' => $category,
    'cateComps' => $cateComps
]) ?>

                      <!-- Info Text -->
                    <div class="col-lg-12">
                        <p class="small-print"><?= $category->table_risk ?> </p>



                        <h3><?= $category->getHowToHeading() ?></h3>
                        <?= Markdown::convert($category->how_to_choose) ?>
                    </div>
                
                </div>
           </div>
        </div> 


<?php

$this->registerJs(
   '$(document).ready(function(){ 

        var currentBaseUrl = "' . Url::current(['filter'=>null]) . '";
        $(document).on("change", "#reg-filter", function(e, id) {
            var id = $("#reg-filter").val();

            if (id >0 ) {
              window.location.href = currentBaseUrl + "?filter="+id;
            } else {
              window.location.href = currentBaseUrl;
            }
        });
    });'
);

?>