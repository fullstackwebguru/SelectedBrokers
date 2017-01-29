<?php

/* @var $this yii\web\View */

use frontend\widgets\Banner;
use yii\helpers\Url;
use frontend\widgets\Rating;
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

<!-- table section-->
    <section id="tables-1">
        <div class="container">
            <h1 class="headlines-comp">FEATURE<span class="red"> COMPARISON</span></h1>
            <?= Markdown::convert($model->description) ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="top-question-comp"><i class="fa fa-question-circle" aria-hidden="true"></i> Wondering how we rank the casinos?</p>
                </div>
            </div>
            <div class="table-condensed desk">
                <table class="table">
                    <thead>
                        <tr class="header-titles">
                            <th class="hearder-box-comp"><p class="hbc">#</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Casino site</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Mobile</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Instant Play</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Download version</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Live Casino</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">VIP Program</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Play</p></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $compIndex = 0;
                    foreach ($companies as $company ) {
                        if ($company->status != 1) {
                            continue;
                        }
                        $compIndex++;
                        $companyLogo = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
                    ?>
                        <tr>
                            <td class="offers-comp"><?= $compIndex?></td>
                            <td class="t-images-comp">
                                <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>'); return false;"> <img src="<?= $companyLogo ?>" class="img-responsive t-img-company" alt="casino-img"> </a>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_mobile > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_instant_play > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>

                            <td class="padd-comp">
                                <?php if ($company->feature_download > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_live_casino > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_vip_program > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="btn-padd-1"><a href="<?= $company->website_url ?>" class=" btn btn-comp btn-primary" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>'); return false;">PLAY</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
