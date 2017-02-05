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
        $data = $client->getQuotes(array("^GSPC", "3086.HK", "AAPL", "XCT9.L")); //Multiple stocks at once

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

                $currHistory = array_reverse($currHistory);

                $name = $value['Name'];

                switch ($value['symbol']) {
                    case '3086.HK':
                        $name = "NASDAQ100";
                        break;
                    case 'AAPL':
                        $name = "Apple";
                        break;
                    case 'XCT9.L':
                        $name = "WTI CRUDE";
                        break;
                }

                $this->stocks[] = array(
                    'symbol' => $value['symbol'],
                    'name' => $name,
                    'open' => $value['Open'] ? $value['Open'] : $value['Ask'],
                    'change' => trim($value['Change']),
                    'percent_change' => trim($value['ChangeinPercent']),
                    'trend' => $trend,
                    'history' => $currHistory
                );
            }
        }

        $exchange = $client->getQuotes(array("EURUSD=X", "GBPUSD=X"));

        if (isset($exchange['query']) && $data['query']['count'] > 0) {
            $quotes = $exchange['query']['results']['quote'];
            foreach ($quotes as $key => $value) {

                $change = trim($value['Change']);
                $sign = substr($change,0,1);

                $trend = $sign == "+" ? true : false;

                $currHistory = [];

                $compareSymbol = "";
                switch ($value['symbol']) {
                    case 'EURUSD=X':
                        $compareSymbol = 'EUR=X';
                        break;
                    case 'GBPUSD=X':
                        $compareSymbol = 'GBP=X';
                        break;
                    default:
                        break;
                }

                $stockHistory = $client->getHistoricalData($compareSymbol, new \DateTime('-5 week') , new \DateTime("now"));

                if (isset($stockHistory['query']) && $stockHistory['query']['count'] > 0) {
                    $historyValues = $stockHistory['query']['results']['quote'];
                    foreach ($historyValues as $history) {
                        $currHistory[] = 1/$history['Open'];
                    }
                }

                $currHistory = array_reverse($currHistory);

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
