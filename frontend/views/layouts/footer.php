<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<!-- Footer -->
    <footer>
        <div class="row">
            <div class="container">
            <div class="col-lg-12">
                <ul class="footer-nav nav navbar-nav navbar-left">
                    <li class="active">
                        <?=  Html::a('Home',['/']) ?>
                    </li>
                    <li>
                        <?=  Html::a('About',['/site/about']) ?>
                    </li>
                    <li>
                        <?=  Html::a('Privacy',['/site/policy']) ?>
                    </li>
                     <li>
                        <?=  Html::a('Terms of Use',['/site/tos']) ?>
                    </li>
                    <li>
                        <?=  Html::a('Disclaimer',['/site/disclaimer']) ?>
                    </li>
                    <li>
                        <?=  Html::a('Contact',['/site/contact']) ?>
                    </li> 
  
            </ul>    
            </div>
            <div class="col-lg-12">
                <p class="copyright-text">SELECTEDBROKERS.COM All rights reserved 2017</p>
                </div>
            </div>
        </div>
    </footer>