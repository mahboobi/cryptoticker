<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coins {
	var $CI;

	function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('coins_hourly_model');
		$this->CI->load->model('coins_meta_model');
		$this->CI->load->model('coins_historic_model');
	}

	function getCoinById($coin_id = false){
		if(!$coin_id) return false;
		return $this->CI->coins_meta_model->getById($coin_id);
	}

	function get24HourPrices($coin_id, $ref_date = false){ // coin_id - string or array
		if(is_array($coin_id)){
			$data = array();
			$rs = $this->CI->coins_hourly_model->getListOfCoins24H($coin_id, $ref_date);  // not sorted by ranks
			if(!$rs) return false;

			foreach($rs as $k => $r){
				if(!isset($data[$r->coin_id])) $data[$r->coin_id] = array();
				$data[$r->coin_id][] = $r;
			}
			return $data;
		} else {
			return $this->CI->coins_hourly_model->getBy24Hour($coin_id, $ref_date);
		}
	}

	function getCoinList($limit = 100, $page = 1, $structuredByID = false){
		return $this->CI->coins_meta_model->getAll($limit, $page, $structuredByID);
	}

	function getByDays($coin_id, $days = 1, $ref_date = false){
		return $this->CI->coins_hourly_model->getByDays($coin_id, $ref_date);
	}

	function getTopGainers($limit = 10){
		return $this->CI->coins_meta_model->getTopGainers($limit);
	}

	function getTopLoosers($limit = 10){
		return $this->CI->coins_meta_model->getTopLoosers($limit);
	}

	function getMovers($limit = 10){ // shd not be only volume... but ok for now
		return $this->CI->coins_meta_model->getByVolume($limit);
	}

	function get24hPriceDifference($coin_id){ // coin_id - string or array
		$data = array();
		$rs = $this->CI->coins_meta_model->getById($coin_id);

		foreach($rs as $k => $v){
			if(!isset($data[$v->coin_id])) $data[$v->coin_id] = array();
			$data[$v->coin_id]['price_usd'] = $v->price_usd;
			$data[$v->coin_id]['price_usd_24h_old'] = round(($v->price_usd * 100) / (100 + $v->percent_change_24h), 6);
			$data[$v->coin_id]['percent_change_24h'] = $v->percent_change_24h;
		}

		return $data;
	}

	function getHistoricByDays($coin_id, $days = 31, $ref_date = false){
		return $this->CI->coins_historic_model->getByDays($coin_id, $days, $ref_date);
	}
}