<?php

class coins_hourly_model extends mymodel {
	
	var $tableName = 'coins_hourly';
	var $memcExpire = 1200; //20 mins
	
	function __construct() {
		parent::set('tableName', $this->tableName);
		//$this->info = new stdClass(); // for runtime caching
	}

	function isExists($coin_id, $date, $last_updated){
		return $this->select('*', array('coin_id'=>$coin_id, 'date' =>$date, 'last_updated'=>$last_updated));
	}

	/*function getByMonth($month){
		$rs = $this->select('*', array('month'=>$month), true);
		if(!$rs) return false;

		return $rs;
	}*/

	function getBy24Hour($coin_id, $ref_date = false){ // last 24 hour
		if(!$coin_id) return false;

		if($ref_date) $now = strtotime($ref_date);
		else $now = time();

		$ts1 = $now - (25 * 60 * 60); // 25 hr - 24 will reduce last 1 hour

		return $this->select('coin_id, price_usd, last_updated, insert_ts', 
			array('coin_id'=>$coin_id, 'last_updated >=' => $ts1, 'last_updated <=' => $now ), true, 'last_updated ASC'
		);
	}

	function getByDays($coin_id, $days = 1, $ref_date = false){
		if(!$coin_id) return false;

		if(!$ref_date) $ref_date = date('Y-m-d');
		$now = time();

		$ts1 = strtotime($date . '-'.$days.'day');

		return $this->select('coin_id, price_usd, last_updated, insert_ts', 
			array('coin_id'=>$coin_id, 'last_updated >=' => $ts1, 'last_updated <=' => $now ), true
		);
	}

	function getListOfCoins24H($coin_ids, $ref_date = false){
		if(!is_array($coin_ids)) return false;

		if($ref_date) $now = strtotime($ref_date);
		else $now = time();

		$ts1 = $now - (25 * 60 * 60); // 25 hr

		return $this->select('coin_id, price_usd, last_updated, insert_ts', 
			array('last_updated >=' => $ts1, 'last_updated <=' => $now ), true, 'last_updated ASC', false, 1, 0, false, 
			array('coin_id' => $coin_ids)
		);
	}

	function prepareData($obj){
		$fields_tpl = array(
        "id", 
        "name", 
        "symbol", 
        "rank", 
        "price_usd", 
        "price_btc", 
        "24h_volume_usd", 
        "market_cap_usd", 
        "available_supply", 
        "total_supply", 
        "max_supply", 
        "percent_change_1h", 
        "percent_change_24h", 
        "percent_change_7d", 
        "last_updated"
    	); // coinmarketcap fields template

		$data = new stdClass();
		$data->coin_id = $obj->id;
		foreach($fields_tpl as $field){
			if(isset($obj->$field)) $data->$field = $obj->$field;
		}
		unset($data->id);

		return $data;
	}
	
}