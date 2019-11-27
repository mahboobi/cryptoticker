<?php

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->viewData['module'] = 'homepage';
		//$this->load->model('users_model');
		//$this->auth->check();
	}
	
	function index(){
		//redirect('/exchange');
		$this->viewData['page'] = 'welcome';
		$this->utils->loadViewController();
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */