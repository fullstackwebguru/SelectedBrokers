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

?>

<!-- Page Content -->
   
    
       <div class="row" id="forex-header">
           <div class="container">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $category->getTableHeading() ?></h1>
            </div>
               </div>
        </div>
    
    
    
       <div class="row">
            <div class="container" id="toplist-table">
                <div class="col-lg-12">
                    
                    
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



