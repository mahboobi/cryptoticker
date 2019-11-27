<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	var $CI;
	var $privateSecret = 'SDF4534ERdfgdfg^$*W#&fghfghD$$345';

	function __construct(){
		$this->CI = & get_instance();
		//$this->CI->loggedIn = false;
		//$this->CI->self_fb_uid = 0;
		$this->CI->viewData = array();
		if(!$this->CI->input->is_cli_request()){
			$this->CI->load->library('session');
			//$this->CI->config->set_item('load_db_default', true);
		}
		
		if($this->CI->config->item('load_db_default'))
			$this->_loadDB();
		$this->CI->load->model('mymodel');
		//$this->CI->load->model('users_model');
		$this->CI->load->driver('cache');
		if(!$this->CI->input->is_cli_request()){
			$this->isLoggedIn();
		}

	}
	
	function _loadDB(){
		$this->CI->DB_Master = $this->CI->load->database('master',TRUE);
		$this->CI->DB_Slave = & $this->CI->DB_Master;
		//$this->CI->DB_Slave = $this->CI->load->database('slave',TRUE);;
	}
	
	function isLoggedIn(){ 
		$this->CI->selfUid = $this->CI->session->userdata('uid');
		$this->CI->userType = $this->CI->session->userdata('utype');
		$this->CI->selfUserName = false;
		if($this->CI->selfUid) {
			//$selfUser = $this->CI->users_model->getSelfUser();
			//if($selfUser) $this->CI->selfUserName = $selfUser->username;
			//else return false;
			$this->CI->selfUser = new stdclass();
			$this->CI->selfUser->displayName = $this->CI->selfUserName = $this->CI->selfUid;
			return true;
		}
		return false;
	}
	
	function createSession($usr, $url = false){
		//$this->destroy(false);
		$this->CI->selfUid = $sessionData['uid'] = $usr->id;
		$this->CI->self_fbid = $sessionData['fb_uid'] = $usr->fb_uid;
		//if($this->CI->session->userdata('suid')) $this->CI->session->unset_userdata('suid'); /// its not reqd
		$this->make($sessionData, $url);
	}
	
	function make($data, $redirectPath = false){
		$this->CI->session->set_userdata($data);
		if($redirectPath) redirect($redirectPath);
	}
	
	function check($loginRequired = true){
		//$f = true;
		//if($this->CI->api) return $this->checkApiToken();
		if($loginRequired && !$this->CI->selfUid)
			$this->loginRequired();
		//return ;
	}
	
	function getLoginUrl(){
		$protocol = ENV == 'dev' ? 'http' : 'http';
		return $protocol.'://'.base_domain . '/account/login?fwdurl='.urlencode(ltrim($_SERVER['REQUEST_URI'], '/'));
	}
	
	function getLogoutUrl(){
		//$protocol = ENV == 'dev' ? 'http' : 'https';
		$protocol = 'http';
		return $protocol.'://'.base_domain . '/account/logout';
	}
	
	function loginRequired($type = false){
		//if($this->CI->api) return apiResponse(array('errorType' => 'token'), 'please login again');
		$url = $this->getLoginUrl(); //'/auth/login';
		redirect($url); //?cih&fbh
	}
	
	function destroy($redirect = true){
		$this->CI->session->sess_destroy();
		$this->CI->userType = false;
		$this->CI->selfID = false;
		if($redirect) redirect('');
	}
	
	function checkToken($token){ // timestamp based chk shd be there... dont accept token created 1 hr back
		$t = explode('_', $token);
		if(empty($t) || count($t) != 3) return false;
		$token = $t[0];
		$string = $t[1];
		$sharedSecret = $t[2];
		//$string = urlencode($string);
		//		pr( md5($this->privateSecret . $string . $sharedSecret));
		//		pr($this->privateSecret,1,1);
		return $token == md5($this->privateSecret . $string . $sharedSecret) ? urldecode($string) : false;
	}

	function makeToken($string, $sharedSecret = false){// sharedscret should/could be unix timestamp
		if(!$sharedSecret) $sharedSecret = time();
		$string = urlencode($string);
		//		pr(md5($this->privateSecret . $string . $sharedSecret).'_'.$string.'_'.$sharedSecret);
		return md5($this->privateSecret . $string . $sharedSecret).'_'.$string.'_'.$sharedSecret;
	}
	
	function checkApiToken(){
		if(!$this->CI->api) return false;
		if($this->CI->api && !$this->CI->token) return apiResponse(array(), 'token', 'AUTH_TOKEN_NULL');
		$this->CI->selfUid = $this->checkToken($this->CI->token);
		if(!$this->CI->selfUid) return apiResponse(array(), 'token', 'AUTH_TOKEN_BAD');
	}
	
}

?>