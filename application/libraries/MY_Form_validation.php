<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	
	function __construct($params = array()){
		 parent::__construct($params);
		 //$this->CI = & get_instance();
		// $this->CI->load->config('form_validation');
		//pr($this->CI);
		 $this->CI->load->language('my_validation', 'english');
	}
	
	function alpha_dash_space($str)	{
		return ( ! preg_match("/^([-a-z0-9_-\s])+$/i", $str)) ? FALSE : TRUE;
	}
	
	function alpha_dashes($str) // w/o underscores
	{
		return ( ! preg_match("/^([-a-z0-9-])+$/i", $str)) ? FALSE : TRUE;
	}
	
	function html_clean($str, $return = false){
		$str = cleanHtmlTags($str, 'simple');
		$str = closeUnclosedTags($str);
		if($return) return $str;
		$_POST[$this->_current_field] = $str;
	}
	
	function html_clean_blogs($str, $return = false){
		$str = cleanHtmlTags($str);
		$str = closeUnclosedTags($str);
		if($return) return $str;
		$_POST[$this->_current_field] = $str;
	}
	
	function html_clean_complete($str, $return = false){
		$str = htmlspecialchars(strip_tags($str), ENT_QUOTES);
		if($return) return $str;
		$_POST[$this->_current_field] = $str;
	}
	
	function html_clean_special($str, $return = false){
		//$str = cleanHtmlTags($str);
		$str = htmlspecialchars($str, ENT_QUOTES);
		if($return) return $str;
		$_POST[$this->_current_field] = $str;
	}
	
	function xss_clean_withStyle($str){
		$_POST[$this->_current_field] = $this->CI->input->xss_clean($str, true);
	}
	
	function keyword_remove($str){
		$_POST[$this->_current_field] = $this->CI->utils->keywordRemoval($str);
	}
	
	function set_my_rules($source, $target){
		if(is($this->_config_rules[$source]) && is($this->_config_rules[$target])){
			$this->_config_rules[$target][] = $this->_config_rules[$source];
		}
	}
	
	function valid_username($str){
		return (! preg_match('/^[a-z][a-z0-9_\-\.]+$/i', $str)) ? false : true;
	}
	
	function valid_gender($str){
		return ($str == 'male' || $str == 'female') ? true : false;
	}
	
	function set_my_error_message($field, $message){
		if(isset($this->_field_data[$field]) && !is($this->_field_data[$field]['error'])){
			$this->_field_data[$field]['error'] = $message;
			//if(!isset($this->_error_array[$field])) 
				$this->_error_array[$field] = $message;
		}
	}
	
	public function set_checkbox2($field = '', $value = '', $default = FALSE)
	{
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default == $value AND count($this->_field_data) === 0)
			{
				return ' checked="checked"';
			}
			return '';
		}

		$field = $this->_field_data[$field]['postdata'];

		if (is_array($field))
		{
			if ( ! in_array($value, $field))
			{
				return '';
			}
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
		}

		return ' checked="checked"';
	}
	
}

?>