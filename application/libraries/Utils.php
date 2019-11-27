<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Utils {
	var $CI;
	var $apiErrorData;
	
	function __construct(){
		$this->CI = & get_instance();
		//$this->CI->load->helper('tools_helper');
		cleanPostData();
		//$this->CI->SCRIPT_URL = $this->CI->input->server('SCRIPT_URL');
		//$this->CI->QUERY_STRING = $this->CI->input->server('QUERY_STRING');
		//$this->CI->REQUEST_URI = $this->CI->input->server('REQUEST_URI'); // includes get params
		$this->CI->HTTP_REFERER = urlencode($this->CI->input->server('HTTP_REFERER'));
		
		$this->CI->ajx = $this->CI->input->get('ajx');
		$this->CI->out = $this->CI->input->get('out');
		
		$GLOBALS['APP_CLASS'] = $this->CI->CLASS = strtolower(@$this->CI->uri->rsegments[1]);
		$GLOBALS['APP_METHOD'] = $this->CI->METHOD = strtolower(@$this->CI->uri->rsegments[2]);
		//$this->CI->SEGMENTS = $this->CI->uri->segments;
		if(!$this->CI->input->is_cli_request()){
			$this->CI->output->set_header('Cache-Control: private, no-store, no-cache, must-revalidate');
			$this->CI->output->set_header('Expires: -1');
			$this->CI->output->set_header('Proxy-Connection: keep-alive');
			if($this->CI->ajx && $this->CI->out != 'html') {
				$this->CI->output->set_header('Content-Type: application/javascript'); //	application/json
				//header('Content-Type: application/javascript');
			} else $this->CI->output->set_header('Content-Type: text/html; charset=UTF-8');
		}
		
		$this->commonTask();
		
		if(ENV != 'prd'){ // in prd create this dirs
			//chkDir($this->CI->config->item('root_tmp_path'));
			//chkDir($this->CI->config->item('tmp_path'));
			//chkDir($this->CI->config->item('cache_path'));
		}
		
		//if($this->CI->selfUserName == 'Bits' && !$this->CI->ajx){
		//	$this->CI->output->enable_profiler(TRUE);
		//}
	}
	
	function commonTask(){
		// stuffs todo here...
	}
	
	function loadViewController(){
		$this->CI->load->view('controller');
	}
	
	function validationErrors($p = '<div class="errormsg">', $s = '</div>'){
		if(isset($this->CI->validation->error_string) && $this->CI->validation->error_string) return $p. $this->CI->validation->error_string .$s;
		return '';
	}
	
	function setValidationError($msg){
		$this->CI->validation->error_string = '<li>'.$msg.'</li>';
	}
	
	function makePrettyUrl(){
		$allowedchars = $this->CI->config->item('permitted_uri_chars');
		//
	}
	
	function output($data = false, $redirect = '', $call = false){
		if($this->CI->ajx){
			if(!$_POST && $call == 'show_404') set_status_header(404);
			return print json_encode($data);
		} else {
			if($call && is_callable($call)) return $call();
			if($redirect) {
				if($redirect === true) $redirect = '';
				redirect($redirect);
			}
			return $this->loadViewController();
		}
	}
	
	function jsonResponse($data){
		return print json_encode($data);
	}
	
	function jsonException($msg, $code, $data = array()){
		$data['exception']['msg'] = $msg;
		$data['exception']['code'] = $code;
		echo json_encode($data);
		die();
	}
	
	
	function prepareValidationDate($case){
		switch($case){
			case 'dob':
				$dob = '';
				$day = $this->CI->input->post('dayOB');
				$month = $this->CI->input->post('monthOB');
				$year = $this->CI->input->post('yearOB');
				if($day && $month && $year) {
					if($day == '29' && $month == '2') $day = $_POST['dayOB'] = '28';
					$dob = $month.'-'.$day.'-'.$year;
				}
				$_POST['dob'] = $dob;
				break;

			case 'date':
				$date = '';
				$day = $this->CI->input->post('day');
				$month = $this->CI->input->post('month');
				$year = $this->CI->input->post('year');
				if($day && $month && $year) {
					$date = $month.'-'.$day.'-'.$year;
				}
				$_POST['date'] = $date;
				break;
		}

	}

	function fileValidation($field, $type = 'image', $validation = array(), $functionName){ // single upload
		if(!isset($_FILES[$field])) return false;
		if($_FILES[$field]['error'] != 0) {
			$this->CI->validation->set_message($functionName, $this->CI->lang->line('error_file_upload'));
			return false;
		}
		//is_uploaded_file()
		if($validation['size'] < $_FILES[$field]['size']) {
			$this->CI->validation->set_message($functionName, $this->CI->lang->line('error_file_size'));
			return false;
		}
		switch ($type){
			case 'image':
				$gis = @getimagesize($_FILES[$field]['tmp_name']);
				if(!$gis) {
					$this->CI->validation->set_message($functionName, $this->CI->lang->line('error_bad_image'));
					return false;
				}
				$imgType = array('image/bmp', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
				if(!in_array($gis['mime'], $imgType)){
					$this->CI->validation->set_message($functionName, $this->CI->lang->line('error_bad_imagetype'));
					return false;
				}
				if($gis[0] < $validation['x'] || $gis[1] < $validation['y']){
					$this->CI->validation->set_message($functionName, $this->CI->lang->line('error_bad_imagedimension') . $validation['x'].'x'.$validation['y']);
					return false;
				}
				break;
			case 'video':
				break;
		}
		return true;
	}
	
	function isFileUpload($field){
		if(!$_FILES || (isset($_FILES[$field]) && !$_FILES[$field]['name']) ) return false;
		return true;
	}

	function getPic($uid, $size = 'big'){
		$usrInfo = $this->CI->users_model->getUserInfo($uid);
		$picurl = false;
		$f = 'pic_'.$size;
		if(is($usrInfo->$f)) $picurl = $usrInfo->$f;
		else {
			if($size == 'big') $fb_pic_type = 'large';
			elseif($size == 'small') $fb_pic_type = 'small'; 
			else $fb_pic_type = 'square';
			if($usrInfo->fb_uid && $usrInfo->use_fb_pic) $picurl = $this->getFBPic($usrInfo->fb_uid, $fb_pic_type);
		}
		if(!$picurl) $picurl = '/img/profile.gif';
		return $picurl;
	}
	
	function getFBPic($fb_uid, $type = 'small'){ // square small normal large
		if(!$fb_uid){
			switch($type){
				case 'square': $img = 'no-profilepic-square.gif'; break;
				case 'small': $img = 'no-profilepic-small.jpg'; break;
				case 'normal': $img = 'no-profilepic-normal.jpg'; break;
				case 'large': $img = 'no-profilepic-large.gif'; break;
				default: $img = 'no-profilepic-normal.jpg';
			}
			return $this->CI->config->item('imagePath') . $img;
		}
		return 'http://graph.facebook.com/'.$fb_uid.'/picture?type='.$type;
	}
	
	function fbLikeFrame($url, $width = 450){
		return '<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode($url).'&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:80px;" allowTransparency="true"></iframe>';
	}
	

	function setSurl($url = false){
		$sessionurl = html_entity_decode($this->CI->input->get('surl'));
		if(!$sessionurl) $sessionurl = $url;
		if($sessionurl){//echo 123;
			$this->CI->load->helper('cookie');
			//echo $this->CI->REQUEST_URI; die();
			set_cookie('surl', urlencode($sessionurl), 0);
			//echo get_cookie('surl');echo 123;
		}
	}
	
	function getSurl($delete = true){
		$this->CI->load->helper('cookie');
		$surl = urldecode(get_cookie('surl'));
		if($delete && $surl) delete_cookie('surl');
		return $surl;
	}
	
	function getImageKey($size, $type, $obj_id){ //type - pin / user, size -> tiny, medium, big
		$key = $type .'/';
		$salt = uniqid();//'yaari-travel';
		$key .= $obj_id.'_'.$salt.'_'.$size{0};
		return $key;
	}
	
	function doUserTask($user){
		if(!is_object($user))
			$user = $this->CI->users_model->getUserInfo($user);
		if(!$user) return false;
		$task = $user->y_task ? json_decode($user->y_task, true) : false;
		if($task){
			$old_task = $task;
			foreach($task as $n => $t){
				$task_code = key($t);
				switch($task_code){
					case 's3_delete':
						$this->CI->load->library('Aws');
						$status = $this->CI->aws->S3_deleteFile($t[$task_code]);
						unset($task[$n]);
						break;
				}
			}
			$data = array();
			if(empty($task)){
				$data['y_task'] = null;
			} elseif($task != $old_task){
				$data['y_task'] = json_encode($task);
			}
			if(!empty($data)) $this->CI->users_model->saveUser($user, $data);
		}
		return;
	}
	
	function addUserTask($user, $task){
		if(!is_object($user))
			$user = $this->CI->users_model->getUserInfo($user);
		if(!$user || !$task) return false;
		$user_task = $user->y_task ? json_decode($user->y_task, true) : array();
		$user_task[] = $task;
		return $this->CI->users_model->saveUser($user, array('y_task'=>json_encode($user_task)));
	}
	
	function getPlaceMapImage($place, $size = '200x200', $zoom = 11){
		if(!$place) return false;
		if(!$place->lat || !$place->long) return false;
		return 'http://maps.googleapis.com/maps/api/staticmap?center='.$place->lat.','.$place->long.'&zoom='.$zoom.'&size='.$size.'&maptype=roadmap&sensor=true';
	}
	
	function getPlaceMapUrl($place, $zoom = 12){
		if(!$place) return false;
		if(!$place->lat || !$place->long) return false;
		return 'http://maps.google.com/maps?z='.$zoom.'&t=m&q=loc:'.$place->lat.'+'.$place->long;
		//return 'http://maps.google.com/?q='.$place->lat.','.$place->long;
	}

	function getExpiryMonth($date = false){
		if(!$date) $date = date('Y-m-d');
		$expiry = $this->CI->config->item('expiry');
		$expiries = array();
		$ts = strtotime($date);
		$year = date('Y', $ts);
		if(!isset($expiry[$year])) return false;
		$expiry = $expiry[$year];

		foreach($expiry as $k => $expMonth){
			$exp_ts = strtotime($expMonth .' +1day');
			if($ts < $exp_ts) break;
		}
		// wont work after last expiry in dec2015
		return $expMonth;
	}
	
}
