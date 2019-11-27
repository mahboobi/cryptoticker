
<?php
class coins_meta_model extends DataModel {

	protected $tableName = "coins_meta";
	//protected $_fields = array(); // schema/columns - for safe check
	protected $primary_key = 'coin_id';

	protected $_cache_enabled = false;
	protected $_cache_sync_method = 'update'; // delete
	protected $_cache_expiry = 600; // minutes
	protected $_cache_sync_callback = '';

	function __construct($id = false, $_dataLoader = 'get') {
		if($id) {
			$rs = $this->$_dataLoader($id);
			if($rs) $this->_load($rs, true);
		}
	}

	public function getAll($limit = 100, $page = 1, $structured = false){

		$rs = $this->select('*', false, true, 'rank ASC', $limit, $page);

		if($structured){
			return $this->_structuredByID($rs);
		}
		return $rs;
	}

	public function getById($coin_id){ // coin_id - string or array
		if(!$coin_id) return false;

		if(is_array($coin_id)){
			return $this->select('*', false, true, false, false, 1, 0, false, array('coin_id' => $coin_id));
		} else {
			return $this->select('*', array('coin_id' => $coin_id));
		}
	}

	public function getTopGainers($limit = 10){
		//$where = array('rank < ', 100);
		return $this->select('*', array('market_cap_usd >' => 100000000), true, 'percent_change_24h DESC', $limit);
	}

	public function getTopLoosers($limit = 10){
		//$where = array('rank < ', 100);
		return $this->select('*', array('market_cap_usd >' => 100000000, 'percent_change_24h !=' => 'NULL'), true, 'percent_change_24h ASC', $limit);
	}

	public function getByVolume($limit = 10){
		return $this->select('*', false, true, '24h_volume_usd DESC', $limit);
	}

	private function _structuredByID($rs){
		if(!$rs) return $rs;
		$data = array();
		foreach ($rs as $key => $obj) {
			$data[$obj->coin_id] = $obj;
		}
		return $data;
	}

	public function prepareData($data, $loadObj = true){
		$fields = array('coin_id', 'name', 'symbol', 'rank', 'market_cap_usd', '24h_volume_usd', 'available_supply', 'total_supply', 'max_supply', 'price_usd', 'price_btc', 'links', 'tags', 'percent_change_1h', 'percent_change_24h', 'percent_change_7d');
		//$low = array('name');
		if(is_object($data)) $data = (array) $data;

		$return = array();
		foreach ($fields as $v){
			if (array_key_exists($v, $data)){ //&& strlen($data[$v]) > 0
				//if(in_array($v, $ucf)) $data[$v] = ucfirst($data[$v]);
				//if(in_array($v, $low)) $data[$v] = strtolower($data[$v]);
				//if(in_array($v, $up)) $data[$v] = strtoupper($data[$v]);

				$return[$v] = $data[$v];
			} else {
				//if(in_array($v, $checkbox)) $data[$v] = isset($data[$v]) &&  $data[$v] ? 1 : 0;
				//$return[$v] = $data[$v];
			}
		}
		//pr($return); die();
		if($loadObj) $this->setData($return, false, true);
		return $return;
	}
}
