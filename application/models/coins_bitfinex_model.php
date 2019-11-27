<?php

class coins_bitfinex_model extends mymodel {
	
	var $tableName = 'coins_bitfinex';
	var $memcExpire = 1200; //20 mins
	
	function __construct() {
		parent::set('tableName', $this->tableName);
		//$this->info = new stdClass(); // for runtime caching
	}

	function isExists($pair, $timestamp){
		return $this->select('*', array('pair'=>$pair, 'timestamp' =>$timestamp));
	}

	function getByPair($pair, $date){
		return $this->select('*', array('pair'=>$pair, 'date' =>$date));
	}

	function prepareData($obj){
		$fields_tpl = array(
			"mid","bid","ask","last_price","low","high","volume","timestamp","pair"

    	); // bitfinex fields template  - {"mid":"12082.5","bid":"12082.0","ask":"12083.0","last_price":"12083.0","low":"11621.0","high":"13017.0","volume":"45803.98099175","timestamp":"1516538721.807667171","pair":"BTCUSD"}

		// dsh should be changed to dash ? iot to iota ?

		$data = new stdClass();
		
		foreach($fields_tpl as $field){
			if(isset($obj->$field)) $data->$field = $obj->$field;
		}
		
		$data->base_currency = substr($data->pair, 3);
		$data->coin_symbol = substr($data->pair, 0, 3);

		$data->date = date('Y-m-d', $data->timestamp);
		$data->month = date('Y-m', $data->timestamp);

		$data->insert_ts = time();

		return $data;
	}
	
}