<?php 

use yii\helpers\Url;
?>

<div class="list-box compare-list">
    <div class="list-title">
            <h3>Compare</h3>
        </div>
    <ul class="homepage-list compare-list">
        <?php 
            
            $cateIndex = 0;
            foreach ($categories as$category) { 
        ?>
        <li>
            <a href="<?=Url::toRoute($category->getRoute())?>" title="<?= $category->short_title ?>">
                <h4><?= $category->short_title ?><i class="fa fa-angle-double-right" aria-hidden="true"></i></h4>
            </a>
        </li>

        <?php
            }
        ?>
        
    </ul>
        
    </div>    