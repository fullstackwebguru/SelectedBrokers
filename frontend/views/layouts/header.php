<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Category;
?>

<?php

$categories = Category::find()->orderBy(['self_rank' => 'desc'])->limit(6)->all();

?>

<nav class="navbar navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Url::toRoute(['/']) ?>"><img src="/img/logo.png" alt="Selected Brokers"/></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <?=  Html::a('Home',['/']) ?>
                </li>
            <?php 

                foreach ($categories as $category) {
            ?>
                <li class="active">
                    <a href="<?= Url::toRoute($category->getRoute())?>"><?= $category->short_title ?></a>
                </li>
            <?php
                }
            ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Articles <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?=  Html::a('Reviews',['/review']) ?>
                        </li>
                        <li>
                            <?=  Html::a('News',['/news']) ?>
                        </li>
                       
                    </ul>
                </li>
  
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>