<?php

require APPPATH . 'third_party/aws/aws-autoloader.php';

//use Aws\S3\S3Client;
//use Aws\S3\Exception\S3Exception;

use Aws\Common\Aws;



class Test extends CI_Controller {

	function __construct()	{
		parent::__construct();	
		$this->viewData['module'] = 'test';
		//$this->api = true;
		//$this->load->library('FB');
		//$this->load->model('users_model');
	}
	
	function index() {
		echo 'i am root';
	}

}