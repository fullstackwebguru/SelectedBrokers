<?php

use frontend\widgets\Rating;
use kartik\markdown\Markdown;
use yii\helpers\Url;

?>

<!-- Table Start -->
                     <div class="panel panel-default">
                          <table class="table table-hover table-custom-style">
                                <thead>
                                    <tr>
                                      <th class="rank-th"></th>
                                      <th class="logo-th">Advertiser Disclosure <i class="fa fa-info-circle tooltip2" title="<?= $category->table_advisor_disclosure ?>" aria-hidden="true"></i></th>
                                      <th class="mindep-th">Min Deposit</th>
                                      <th class="promo-th">Promotions</th>
                                      <th class="features-th">Features</th>
                                      <th class="rating-th">Rating</th>
                                      <th class="risk-th">Risk Warning <i class="fa fa-info-circle tooltip" title="<?= $category->table_risk_short ?>" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                              <tbody>

                                                    <?php

                    $compIndex = 0;
                    foreach($cateComps as $catComp) {
                        $company = $catComp->company;
                        if ($company->status != 1) {
                            continue;
                        }

                        $compIndex++;
                        $companyImage = cloudinary_url($company->logo_url, array("width" => 115, "height" => 73, "crop" => "fill"));
                    ?>
                                    <tr>
                                      <td class="rank-td"><?= $catComp->rank+1 ?></td>
                                      <td class="logo-td">
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                                              <img src="<?= $companyImage ?>" alt="<?= $company->title ?>"></a>
                                          </a>
                                        </td>
                                      <td class="mindep-td">£<?= $company->min_deposit ?></td>
                                      <td class="promo-td">
                                          <p class="ammount"><?= $company->bonus_offer ?></p>
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="get-deal"> <?= $company->promotion_link_text ?> </a>
                                        </td>
                                      <td class="features-td">
                                          <ul>
                                          <?php 
                                          foreach($company->features as $feature) {
                                          ?>
                                              <li><i class="fa fa-plus" aria-hidden="true"></i> <?= $feature->value ?></li>
                                          <?php } ?>
                                          </ul>
                                        </td>
                                      <td class="rating-td">
                                        <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute()) ]) ?>
                                        <a href="<?= Url::toRoute($company->getRoute()) ?>" class="review" title="Read Review">Read Review</a>
                                        </td>
                                      <td class="risk-td">
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="button custom-btn" target="_blank" title="Visit Site"><?= $company->button_text ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="get-bonus" target="_blank" title="Get Bonus"><?= $company->link_text ?></a></td>
                                    </tr>

                              <?php  }  ?>
                                </tbody>
                        </table>
                     </div>
                      <!-- Table End --> 