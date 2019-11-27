<?php

$config['tmp_path'] = '/tmp/lazy/';
$config['appLogPath'] = '/tmp/lazy/logs/'; 
$config['logFiles']['app'] = 'app_log';
$config['logFiles']['debug'] = 'debug_log'; // any kinda failures including validations



if(ENV == 'prd') {
	$config['load_db_default'] = true;
	$config['tmp_path'] = '/data/tmp/badrobot/';
    //$config['fb_appId'] = '';
    //$config['fb_secret'] = '';

    //$config['twit_key'] = '';
    //$config['twit_secret'] = '';
    
    $config['assets_domain'] = base_domain;
	
	$config['aws_key'] = '';
	$config['aws_secret'] = '';
	$config['default_from_email'] = 'donotreply@mail.com';
	
	$config['s3_bucket_name'] = 'q';
	$config['google_api_key'] = '';
    
} else if (ENV == 'dev') { 
	$config['load_db_default'] = true;
	$config['tmp_path'] = '/tmp/badrobot/';
    //$config['fb_appId'] = '';
    //$config['fb_secret'] = '';

    //$config['twit_key'] = '';
    //$config['twit_secret'] = '';
    
    $config['assets_domain'] = base_domain;
	
	$config['aws_key'] = '';
	$config['aws_secret'] = '';
	$config['default_from_email'] = 'donotreply@mail.com';
	
	$config['s3_bucket_name'] = 'q';
	$config['google_api_key'] = '';
}

$_GLOBALS['imagePath'] = $config['imagePath'] = '/images/'; //'/yaari-assets/images/';
$_GLOBALS['cssPath'] = $config['cssPath'] = '/css/'; //'/yaari-assets/css/';
$_GLOBALS['jsPath'] = $config['jsPath'] = '/js/'; //'/yaari-assets/js/';

$config['storage_server_domain'] = 's3.amazonaws.com'; // s3-ap-southeast-1.amazonaws.com

$config['storage_host'] = $config['s3_bucket_name'] .'.'. $config['storage_server_domain'];