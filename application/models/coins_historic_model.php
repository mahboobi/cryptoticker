<?php

class coins_historic_model extends mymodel {
	
	var $tableName = 'coins_historic';
	var $memcExpire = 1200; //20 mins
	
	function __construct() {
		parent::set('tableName', $this->tableName);
		//$this->info = new stdClass(); // for runtime caching
	}

	function isExists($coin_id, $date){
		return $this->select('*', array('coin_id'=>$coin_id, 'date' =>$date));
	}

	function getByDays($coin_id, $days = 31, $ref_date = false){ // all
		//if($days == 'all')

		if($ref_date) $now = strtotime($ref_date);
		else $now = time();

		$ts1 = $now - ($days * 25 * 60 * 60);

		return $this->select('*', 
			array('coin_id'=>$coin_id, 'ts >=' => $ts1, 'ts <=' => $now ), true, 'ts ASC'
		);
	}

	/*function getByMonth($month){
		$rs = $this->select('*', array('month'=>$month), true);
		if(!$rs) return false;

		return $rs;
	}*/

	
}