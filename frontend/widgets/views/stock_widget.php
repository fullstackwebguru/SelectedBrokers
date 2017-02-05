<?php 

use yii\helpers\Url;
use frontend\assets\AppAsset;

// echo "<pre>";
// print_r($stocks);
// echo "</pre>";

?>

<!-- Finance widget -->
<div class="container" id="fw-fix">
   <div class="row">
        <div class="col-lg-12">
            <div class="finance-widget">
                <div class="panel panel-default">
                    <ul>
                        <?php foreach($stocks as $key => $stock) { ?>
                        <li>
                            <div class="finance-widget-info">
                                <span class="index-name"><?= $stock['name'] ?></span>
                                <span class="index-ammount"><?= $stock['open'] ?></span>
                                <span class="index-movement <?= $stock['trend'] ? 'green' : 'red' ?>"><i class="fa <?= $stock['trend'] ? 'fa-caret-up' :'fa-caret-down'  ?>" aria-hidden="true"></i>  <?= $stock['change'] ?> (<?= $stock['percent_change'] ?>)</span>
                                <div id="chart_container_<?=$key?>" style="width: 100%; height: 50px; margin: 0 auto" > </div>
                             </div>
                            <?php
                                $js = "";
                                $count = 10;

                                $min = 0;
                                foreach($stock['history'] as $key1 => $value1) {
                                    if ($min > $value1 || $min == 0) {
                                        $min = $value1;
                                    }
                                }

                                foreach($stock['history'] as $key1 => $value1) {
                                    $stock['history'][$key1] = $stock['history'][$key1] - $min;
                                }

                                $js = implode(",", $stock['history']);
                                $js = "[" . $js . "]";

                                $color = $stock['trend'] ? "#008000" : "#ff0000";
                            
                                $html = '
                                    Highcharts.chart("chart_container_'. $key . '", {
                                        colors: ["'. $color . '"],
                                        title:{
                                            text:""
                                        },
                                        tooltip: {
                                            enabled: false
                                        },
                                        exporting: { enabled: false },
                                        credits: {
                                            enabled: false
                                        },
                                        chart: {
                                            type: "area"
                                        },
                                        xAxis: {
                                            lineWidth: 0,
                                            minorGridLineWidth: 0,
                                            lineColor: "transparent",
                                            labels: {
                                               enabled: false
                                            },
                                            minorTickLength: 0,
                                            tickLength: 0
                                        },
                                        yAxis: {
                                            title: {
                                                text: ""
                                            },
                                            lineWidth: 0,
                                            minorGridLineWidth: 0,
                                            lineColor: "transparent",
                                            gridLineColor: "transparent",
                                            labels: {
                                               enabled: false
                                            },
                                            minorTickLength: 0,
                                            tickLength: 0
                                        },
                                        plotOptions: {
                                            series: {
                                                animation: false
                                            }
                                        },
                                        series: [{
                                            showInLegend: false,
                                            data: ' . $js . '
                                        }]
                                    });';

                                $this->registerJs($html);
                            ?>
                            </span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</div>