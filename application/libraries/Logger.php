<?php 
if (! defined ( 'BASEPATH' )) { exit ( 'No direct script access allowed' ); }

/*

Initiated : Tuhin Barua 
Date : 1st May 2013
 

// sample calls from CI libraries
$this->CI->logger->event('gds','msg', __METHOD__);
$this->CI->logger->log('gds', 'msg ----',  __METHOD__);
$this->CI->logger->file('/tmp/travelyaari/gds_log', 'message ----',  __METHOD__);

*/

require_once(APPPATH . 'third_party/Log-pear/Log.php');

class Logger {

	private $CI;
	private $_events = array();
	private $_logsPath;
	private $_logFiles;

	public function __construct(){ 
		$this->CI = & get_instance();
		$this->_logsPath = $this->CI->config->item('appLogPath'); // from app.config
		$this->_logFiles = $this->CI->config->item('logFiles');
	}

	protected $_skipEventTypes = array();


	// adds log event, but dont wirte it immediately, from type get filenames from config, --- big strings/msg should be written immidiately instead of holding it ?
	public function event($type, $msg, $caller = ''){
		if(!isset($this->_events[$type])) $this->_events[$type] = array();
		if(isset($this->_skipEventTypes[$type]))
			return $this->log($type, $msg, $caller);
		else 
			$this->_events[$type][] = $this->_formatEvent($msg, $caller);
		return true;
	}

	private function _formatEvent($msg, $caller){ // platform, ip, session
		return time() . ' [' . $caller . '] ' . $msg;
	}

	public function getEvents(){
		return $this->_events;
	}


	public function setSkipEventType(){
		$types = func_get_args();
		if(is_array($types)) 
			foreach($types as $type) 
				$this->_skipEventTypes[$type] = 1;
	}

	// writes (appends) all the added log events and clear events[]
	public function writeEvents(){
		$conf = array('mode' => 0600, 'timeFormat' => '%X %F', 'lineFormat' => '%1$s %4$s'); // %2$s [%3$s]
		$logger = &Log::singleton('file', false, 'ident', $conf);

		$stat = false;
		foreach($this->_events as $type => $events){
			if(!isset($this->_logFiles[$type])) continue;
			$logger->setFileName($this->_logsPath . $this->_logFiles[$type]);
			$stat = $logger->logMessages($events);
			//unset($this->_events[$type]);
		}
		$this->_events = array(); // do this or enabls unset() above
		return $stat;
	}

	// writes to file directly
	public function log($type, $msg, $caller = ''){
		if(!isset($this->_logFiles[$type])) return false;
		return $this->file($this->_logsPath . $this->_logFiles[$type], $msg, $caller);
	}

	public function file($fileName, $content, $caller = ''){
		$conf = array('mode' => 0600, 'timeFormat' => '%X %F', 'lineFormat' => '%1$s %4$s'); // %2$s [%3$s]
		$logger = &Log::singleton('file', $fileName, 'ident', $conf);
		$content = $this->_formatEvent($content, $caller);
		return $logger->log($content);
	}

	public function mail(){

	}

	public function console(){

	}

	
}

?>
