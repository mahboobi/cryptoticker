<?php

class coins_binance_model extends mymodel {
	
	var $tableName = 'coins_binance';
	var $memcExpire = 1200; //20 mins
	
	function __construct() {
		parent::set('tableName', $this->tableName);
		//$this->info = new stdClass(); // for runtime caching
	}

	function isExists($symbol, $closeTime){
		return $this->select('*', array('symbol'=>$symbol, 'closeTime' =>$closeTime));
	}

	function getByPair($pair, $date){
		return $this->select('*', array('symbol'=>$pair, 'date' =>$date));
	}

	function prepareData($obj){
		$fields_tpl = array(
			"symbol","priceChange","priceChangePercent","weightedAvgPrice","prevClosePrice","lastPrice","lastQty","bidPrice","bidQty",
			"askPrice","askQty","openPrice","highPrice", "lowPrice","volume","quoteVolume","openTime", "closeTime"

    	); // binance fields template  - {"symbol":"ETHBTC","priceChange":"0.00149200","priceChangePercent":"1.648","weightedAvgPrice":"0.09137090","prevClosePrice":"0.09055200","lastPrice":"0.09204400","lastQty":"0.04300000","bidPrice":"0.09207300","bidQty":"0.06500000","askPrice":"0.09214200","askQty":"0.00200000","openPrice":"0.09055200","highPrice":"0.09260000","lowPrice":"0.09026500","volume":"177241.98400000","quoteVolume":"16194.76006530","openTime":1516532389503,"closeTime":1516618789503,"firstId":24438270,"lastId":24790242,"count":351973}

		// dsh should be changed to dash ? iot to iota ?

		$data = new stdClass();
		
		foreach($fields_tpl as $field){
			if(isset($obj->$field)) $data->$field = $obj->$field;
		}
		
		$data->base_currency = substr($data->symbol, 3);
		$data->coin_symbol = substr($data->symbol, 0, 3);

		$data->openTime = $data->openTime / 1000;
		$data->closeTime = $data->closeTime / 1000;

		$data->date = date('Y-m-d', $data->closeTime);
		$data->month = date('Y-m', $data->closeTime);

		$data->insert_ts = time();

		return $data;
	}
	
}