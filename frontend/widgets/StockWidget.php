<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class StockWidget extends \yii\base\Widget
{

    private $stocks;

    public function init()
    {
        parent::init();

        $client = new \Scheb\YahooFinanceApi\ApiClient();

        $this->stocks = [];
        //Fetch full data set
        $data = $client->getQuotes(array("^GSPC", "GOOGL", "3086.HK", "AAPL")); //Multiple stocks at once

        if (isset($data['query']) && $data['query']['count'] > 0) {
            $quotes = $data['query']['results']['quote'];
            foreach ($quotes as $key => $value) {

                $change = trim($value['Change']);
                $sign = substr($change,0,1);

                $trend = $sign == "+" ? true : false;

                $currHistory = [];
                
                $stockHistory = $client->getHistoricalData($value['symbol'], new \DateTime('-5 week') , new \DateTime("now"));

                if (isset($stockHistory['query']) && $stockHistory['query']['count'] > 0) {
                    $historyValues = $stockHistory['query']['results']['quote'];
                    foreach ($historyValues as $history) {
                        $currHistory[] = $history['Open'];
                    }
                }

                $this->stocks[] = array(
                    'symbol' => $value['symbol'],
                    'name' => $value['Name'],
                    'open' => $value['Open'] ? $value['Open'] : $value['Ask'],
                    'change' => trim($value['Change']),
                    'percent_change' => trim($value['ChangeinPercent']),
                    'trend' => $trend,
                    'history' => $currHistory
                );
            }
        }

        //Get historical data
        
    }

    public function run()
    {
        return $this->render('stock_widget', ['stocks'=>$this->stocks]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
