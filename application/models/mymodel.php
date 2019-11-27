	
<?php

// simple data model
// this shd be extends in all other models

if ( ! class_exists('CI_Model')) {
	load_class('Model', 'core');
}

class mymodel extends CI_Model {

	private $master = false;
	private $selectedNumRows = false;
	//var $DB_Master = false;
	//var $DB_Slave = false;

	//protected $CI;

	public function __construct() { //echo 'construct-mymodel';
		parent::__construct();
		//$this->CI = & get_instance();
	} 

	static function call(){ //singleton... reqd?
		if (!mymodel::$caller) {
			mymodel::$caller = new mymodel();
		}
		return mymodel::$caller;
	}

	function set($key, $value){
		$this->$key = $value;
	}

	/*public function __get($key){
		if(isset($this->data[$key])) return $this->data[$key];
		echo get_class($this), '<br />';
		
        return parent::__get($key);
	}

	public function __set($key, $value){ echo $key;
		//if(isset($this->data[$key]))
		$this->data[$key] = $value;
	}

	public function data(){
		return $this->data;
		//echo $this->CI->TS;
	}

	private $data = array();
*/
	
	// if we are calling select just after the insert/update then we have to do some auto caching method inside insert/update method wherever reqd

	function insert($data, $insertId = true){
		if(!$this->tableName || empty($data)) return false; 
		if(isset($this->_insertId)) {
			$insertId = $this->_insertId;
		}
		$stat = $this->DB_Master->insert($this->tableName, $data);//pr($data,1,1);
		if($stat && $insertId) return $this->DB_Master->insert_id();//why both statements are not in single connection??
		return $stat;
	}

	function insertOrUpdate($data, $insertId = false, $autoIncCol = false){
		//will replace it later by a manual select check and accordingly insert or update later(2 db calls), simple and clear.

		if(!$this->tableName) return false;
		//$embedSql = '';
		if($insertId && !$autoIncCol) show_error('autoincrement colomn name not specified');//can fetch it from metadata table.
		//else $embedSql = $autoIncCol.' = last_insert_id(), ';//USEFULL ONLY WHEN WE GIVE NEW AUTOINC FIELD VALUE (here suid)
		if(empty($data)) return false;
		$fields = '';
		$values = '';
		$toUpdate = '';
		foreach($data as $k => $v){
			//$v = $this->DB_Master->escape($v);
			$fields .= $k . ',';
			$values .= $this->DB_Master->escape($v).",";
			$toUpdate .= ", ".$k.' = '.$this->DB_Master->escape($v);
		}
		$fields = trim($fields, ',');
		$values = trim($values, ',');
		$sql = 'INSERT INTO '.$this->tableName.' ('.$fields.') VALUES ('.$values.') ON DUPLICATE KEY UPDATE isDeleted = 0 '.$toUpdate;//mind it we are giving him same autoinc field as previous
		$stat = $this->DB_Master->simple_query($sql);
		if($stat && $insertId){
			$this->master = true;
			$sql = 'SELECT '.$autoIncCol.' FROM '.$this->tableName.' WHERE  isDeleted = 0 '.str_replace(',',' and ',$toUpdate);
			$rs = $this->sql($sql);
			if($rs) return $rs->$autoIncCol;
			return false;
		}
		return $stat;
		//pr(($this->DB_Master->query('select last_insert_id()')->result('object')),1,1);
	}

	function update($where, $data, $deleteKeyFromMemory = false, $dataToMemory = false){

		if(!$this->tableName || empty($data)) return false;
		if(!is_array($where)) return false;
		$this->DB_Master->where($where);
		
		if($dataToMemory) $this->memc->set($deleteKeyFromMemory, $dataToMemory); // update the memory before db update? test
		if($this->DB_Master->update($this->tableName, $data)){
			if(!$dataToMemory && $deleteKeyFromMemory) $this->memc->delete($deleteKeyFromMemory);
			return true;
		} else {
			//$this->memc->delete($deleteKeyFromMemory);   // lets keep it disable for now ?
		}
		return false;
	}

	function purge($where = array('isDeleted' => 1)){
		if(!$this->tableName) return false;
		$this->DB_Master->where($where);
		return $this->DB_Master->delete($this->tableName);
	}
	
	function del($where){
		if(!$this->tableName) return false;
		$this->DB_Master->where($where); 
		return $this->DB_Master->delete($this->tableName);
	}

	function select($cols = '*', $where = false, $multipleRecord = false, $orderBy = false, $limit = false, $page = 1,$extendedLimit=0,$groupBy=false,$wherein=false, $join = false,$returnType=0){ // no limit? 500?
		$this->selectedNumRows = false;
		if(!$this->tableName) return false;
		$DB_HOST = $this->master ? 'DB_Master' : 'DB_Slave';
		$this->$DB_HOST->select($cols);
		if($where && is_array($where)) $this->$DB_HOST->where($where);
		if($wherein && is_array($wherein)) {
			foreach ($wherein as $whereinkey => $whereinvalue) {
				$this->$DB_HOST->where_in($whereinkey, $whereinvalue);
			}
		}
		//if($join){
			
		//}
		if($orderBy) $this->$DB_HOST->order_by($orderBy);
		if($groupBy) $this->$DB_HOST->group_by($groupBy);
		if($limit !== false){
			// will do pagination later... currently forget pagination
			$this->$DB_HOST->limit($limit+$extendedLimit);
			$this->$DB_HOST->offset($limit*($page-1));
			//pr1($limit*($page-1),1,1);
		}
		$query = $this->$DB_HOST->get($this->tableName);
		$this->selectedNumRows = $query->num_rows();
		if ($this->selectedNumRows > 0 ){
			if($this->selectedNumRows == 1 && !$multipleRecord){
				if($returnType == 0){
					$rs = $query->row();	
				}else{
					$rs = $query->row_array();
				}
				
			} else {
				if($returnType == 0){
					$rs = $query->result();	
				}else{
					$rs = $query->result_array();
				}
				
			}
			return $rs;
		}
		return false;
	}

	function sql($sql, $multipleRecord = false){ // only for read
		$this->sqledNumRows = false;
		$sql = trim($sql);
		$DB_HOST = $this->master ? 'DB_Master' : 'DB_Slave';
		// shd chk for is_write_type automatically just for safety?
		$query = $this->$DB_HOST->query($sql);
		$this->sqledNumRows = $query->num_rows();
		if ($this->sqledNumRows > 0 ){
			if($this->sqledNumRows == 1 && !$multipleRecord){
				$rs = $query->row();
			} else {
				$rs = $query->result();
			}
			return $rs;
		}
		return false;
	}

	function simpleSql($sql){ // only for write
		return $this->DB_Master->simple_query($sql);
	}
}

/*
method calls on a single data object will work, currently it wont work in iteration mode on multiple data objects (list), which is fetched in one query
*/
class DataModel extends mymodel {
	private $_data;
	//private $_fields; // strict check
	private $_data_changed = false;
	private $_load = false;

	// defaults
	protected $_cache_enabled = false;
	protected $_cache_sync_method = 'update'; // delete
	protected $_cache_expiry = 10; // minutes

	public function __get($key){
		if(is_object($this->_data) && property_exists($this->_data, $key)) return $this->_data->$key;
		/*$trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $key .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);*/
        return parent::__get($key); // have to think here - in case _data emty and if we are checking for an expected attribute
	}

	public function __set($key, $value){ //echo 1234;
		//if(isset($this->data[$key]))
		if(!is_object($this->_data)) $this->_data = new stdClass();
		//echo $key, '__', $this->_data->$key, '__',  $value, '_';
		//pr($this->_data); 
		if(!$this->_data_changed) $this->_data_changed = (!isset($this->_data->$key) || $this->_data->$key != $value) ? true : false;

		if($this->_data_changed)
			$this->_data->$key = $value;
	}

	public function __unset($key){
		if(property_exists($this->_data, $key)) {
			unset($this->_data->$key);
			$this->_data_changed = true;
		}
	}

	public function __isset($key){
		return isset($this->_data->$key);
	}

	public function data(){
		return $this->_data;
	}

	public function setData($data, $all = false, $dataChanged = false){
		if($all && is_array($data)) {
			$data = (object) $data;
			//or throw error ?
		}
		if($all) {
			$this->_data = $data;
		} else { //pr($data); pr($this->_data); echo 5;
			if(!is_object($this->_data)) $this->_data = new stdClass(); // newly added - something changed in new php - chk later
			
			foreach($data as $k => $v)
				$this->_data->$k = $v;
		}

		$this->_setDataChanged($dataChanged);
	}

	protected function _load($data, $all = false){
		if(!$data) return false;
		$this->_load = true;
		$this->setData($data, $all);
	}

	/**
	 * Don't use these public _
	 * must be used with caution 
	 */
	public function _setDataLoad($flag) {
		$this->_load = $flag;
	}

	public function _setDataChanged($changed = true){
		$this->_data_changed = $changed;
	}

	public function _isDataChanged(){
		return $this->_data_changed;
	}
	/////
	
	public function loaded(){
		return $this->_load;
	}

	public function get($id, $load = false){
		if($this->_cache_enabled){
			$rs = $this->cache->memcached->get($this->_cacheKey($id));
			if(!$rs) {
				if(is_array($id)) $where = $id; // have to do it better later : todo
				else $where = array($this->primary_key => $id);
				$rs = $this->select('*', $where);
				if($rs) {
					$this->cache->memcached->save($this->_cacheKey($id), $rs, $this->_cacheExpiry());
				}
			}
		} else {
			if(is_array($id)) $where = $id;
			else $where = array($this->primary_key => $id);
			$rs = $this->select('*', $where);
		}
		if($load) $this->_load($rs, true);
		return $rs;
	}

	public function save(){
		if($this->_data_changed) {
			$data = $this->data();

			if($this->_load) { // update
				// unset primary-key in data ? not reqd... mysql is smart enuf probably
				if(!isset($data->{$this->primary_key})) {
					// throw error
					return false;
				}
				$where = array($this->primary_key => $data->{$this->primary_key});
				$status = $this->update($where, $data) ? $data->{$this->primary_key} : false;
			} else { // insert
				$insertId = isset($data->{$this->primary_key}) && $data->{$this->primary_key} ? false : true;
				$status = $this->insert($data, $insertId); 
				
				if($status && (!isset($data->{$this->primary_key}) || !$data->{$this->primary_key})) {
					$data->{$this->primary_key} = $status;
					$this->_data_changed = false; //bcoz of insertId - actually its not changed
					$this->_load = true; // on next save() it shd update
				}
				// db default values wont be here
			}

			if($status && $this->_cache_enabled && $data->{$this->primary_key}) { // set in cache
				if($this->_cache_sync_method == 'update') {//pr($data);die();
					$this->cache->memcached->save($this->_cacheKey($data->{$this->primary_key}), $data, $this->_cacheExpiry());
				} else {
					$this->cache->memcached->delete($this->_cacheKey($data->{$this->primary_key}));
				}
			}
		} else {
			$data = $this->data();
			$status = $data->{$this->primary_key}; // no changes : todo : return true or primary id ?
		}
		return $status;
	}

	public function delete(){
		$data = $this->data();
		if(!isset($data->{$this->primary_key})) return false;
		$where = array($this->primary_key => $data->{$this->primary_key});

		$status = $this->del($where);
		if($status && $this->_cache_enabled){
			$this->cache->memcached->delete($this->_cacheKey($data->{$this->primary_key}));
		}
		return $status;
	}

	private function _cacheExpiry(){
		return $this->_cache_expiry * 60;
	}

	private function _cacheKey($id){
		if(is_array($id)) $id = crc32(serialize($id));
		return $this->tableName .'-'. $id;
	}

}

?>