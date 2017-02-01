<?php

use frontend\widgets\Rating;
use kartik\markdown\Markdown;
use yii\helpers\Url;

?>

<!-- Table Start -->
                     <div class="panel panel-default">
                          <table class="table table-hover table-custom-style sortable">
                                <thead>
                                    <tr>
                                      <th data-firstsort data-defaultsort="asc" class="rank-th"></th>
                                      <th data-defaultsort="disabled" class="logo-th">Advertiser Disclosure <i class="fa fa-info-circle tooltip2" title="<?= $category->table_advisor_disclosure ?>" aria-hidden="true"></i></th>
                                      <?php if ($category->show_deposit) { ?>
                                      <th class="mindep-th">Min Deposit</th>
                                      <?php } ?>
                                      <th data-defaultsort="disabled" class="promo-th">Promotions</th>
                                      <?php if ($category->show_regulation) { ?>
                                      <th class="regulations-th" data-defaultsort="disabled">Regulations</th>
                                      <?php } ?>
                                      <th data-defaultsort="disabled" class="features-th">Features</th>
                                      <th class="rating-th">Rating</th>
                                      <th data-defaultsort="disabled" class="risk-th">Risk Warning <i class="fa fa-info-circle tooltip" title="<?= $category->table_risk_short ?>" aria-hidden="true"></i></th>
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
                        $companyImage = cloudinary_url($company->logo_url);
                    ?>
                                    <tr>
                                      <td class="rank-td" data-value="<?= $catComp->rank+1 ?>"><?= $catComp->rank+1 ?></td>
                                      <td class="logo-td" >
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                                              <img src="<?= $companyImage ?>" alt="<?= $company->title ?>"></a>
                                          </a>
                                        </td>
                                        <?php if ($category->show_deposit) { ?>
                                        <td class="mindep-td" data-value="<?= $company->min_deposit ?>">£<?= $company->min_deposit ?></td>
                                        <?php } ?>
                                      <td class="promo-td" data-value="0">
                                          <?php if ($company->bonus_offer_desc) {  ?>
                                          <p class="promo-small"><?= $company->bonus_offer_desc ?></p>
                                          <?php } ?>
                                          <p class="ammount"><?= $company->bonus_offer ?></p>
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="get-deal"> <?= $company->promotion_link_text ?> </a>
                                        </td>
                                      <?php if ($category->show_regulation) { ?>
                                      <td class="regulations-td">
                                        <?php foreach($company->regulComps as $regulComp) {
                                          $regulation = $regulComp->regulation;
                                        ?>
                                        <span><?= $regulation->title ?></span>
                                        <?php 
                                        }
                                        ?>
                                      </td>
                                      <?php } ?>
                                      <td class="features-td" data-value="0">
                                          <ul>
                                          <?php 
                                          foreach($company->features as $feature) {
                                          ?>
                                              <li><i class="fa fa-plus" aria-hidden="true"></i> <?= $feature->value ?></li>
                                          <?php } ?>
                                          </ul>
                                        </td>
                                      <td class="rating-td" data-value="<?= $company->rating ?>">
                                        <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute()) ]) ?>
                                        <a href="<?= Url::toRoute($company->getRoute()) ?>" class="review" title="Read Review">Read Review</a>
                                        </td>
                                      <td class="risk-td" data-value="0">
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="button custom-btn" target="_blank" title="Visit Site"><?= $company->button_text ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                          <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;" class="get-bonus" target="_blank" title="Get Bonus"><?= $company->link_text ?></a></td>
                                    </tr>

                              <?php  }  ?>
                                </tbody>
                        </table>
                     </div>
                      <!-- Table End --> 