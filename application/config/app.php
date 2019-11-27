<?php

$config['api_sign'] = 'badrobot';

$config['y_axis_title'] = 'Web Hits'; // default
$config['graph_type'] = 'spline'; // types are - area, areaspline, bar, column, line, pie, scatter, spline (pie is osmething different, you dont wanna use pie in most of the cases)
$config['dash_style'] = 'solid'; // dashStyle - Solid  ShortDash  ShortDot  ShortDashDot  ShortDashDotDot  Dot  Dash LongDash DashDot LongDashDot LongDashDotDot

$config['time_partition'] = 5; //min default

$config['projects']['TY_Usage'] = array(
	'homepage'=>array('pie'=>true, 'total_table'=>true), 
	'search'=>array('pie'=>false,'pie_elements'=>array(), 'total_table'=>true),
	'checkout'=>array('total_table'=>true),
	'checkout2search'=>array('total_table'=>true),
	'payment'=>array('total_table'=>true),
	'ticket'=>array('total_table'=>true),
	'resource'=>array('total_table'=>true),
	'resource2'=>array('total_table'=>true)
);

$config['projects']['TY_Conversion'] = array(
    'srp2chkout-old'=>array( // OLD
        'y_data'=>'TY_Usage::checkout::beacon', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::checkout::beacon||TY_Usage::search::beacon@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon', 'y1_axis_title' => 'search beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),
    'srp2chkout-v1'=>array(
        'y_data'=>'TY_Usage::checkout::beacon', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::checkout::beacon||TY_Usage::search::beacon_v1@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon_v1', 'y1_axis_title' => 'searchV1 beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),
    'srp2chkout-v2'=>array(
        'y_data'=>'TY_Usage::checkout::beacon', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::checkout::beacon||TY_Usage::search::beacon_v2@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon_v2', 'y1_axis_title' => 'searchV2 beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),
   
	'srp2seat-old'=>array(
        'y_data'=>'TY_Usage::resource::seatchart', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::resource::seatchart||TY_Usage::search::beacon@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon', 'y1_axis_title' => 'search beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),

	'srp2seat-v1'=>array(
        'y_data'=>'TY_Usage::resource::seatchart', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::resource::seatchart||TY_Usage::search::beacon_v1@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon_v1', 'y1_axis_title' => 'searchV1 beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),

    'srp2seat-v2'=>array(
        'y_data'=>'TY_Usage::resource2::seatchart', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::resource2::seatchart||TY_Usage::search::beacon_v2@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::search::beacon_v2', 'y1_axis_title' => 'searchV2 beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),

	'seats_continue'=>array(
        'y_data'=>'TY_Usage::checkout::saveJourney', 'apply_func'=>'average_inverse', 'apply_data'=>'TY_Usage::checkout::saveJourney||TY_Usage::resource::seatchart@@y1', 'y_axis_title'=>'seatchart view / continue hit','extra_y'=>1, 'y1_data'=>'TY_Usage::resource::seatchart', 'y1_axis_title' => 'seatchart hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),

    'seats_continue-v2'=>array(
        'y_data'=>'TY_Usage::checkout::transaction_save', 'apply_func'=>'average_inverse', 'apply_data'=>'TY_Usage::checkout::transaction_save||TY_Usage::resource2::seatchart@@y1', 'y_axis_title'=>'seatchart view / continue hit','extra_y'=>1, 'y1_data'=>'TY_Usage::resource2::seatchart', 'y1_axis_title' => 'seatchart hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    ),

    'chkout2submit'=>array(
    	'y_data'=>'TY_Usage::checkout::submit', 'apply_func'=>'average', 'apply_data'=>'TY_Usage::checkout::submit||TY_Usage::checkout::beacon@@y1', 'y_axis_title'=>'x100 %','extra_y'=>1, 'y1_data'=>'TY_Usage::checkout::beacon', 'y1_axis_title' => 'checkout beacon hits', 'y1_graph' => 'column', 'avg_table'=>'true'
    )
);

$config['projects']['TY_UniqueUsers'] = array('ty'=>array('total_table'=>true, 'hide_graph'=>true));
$config['projects']['TY_Response'] = array(
	'search'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::search::avg_time||TY_Usage::search::total@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::search::total', 'y1_graph'=>'column'), 
	'search2'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::search2::avg_time||TY_Usage::search::beacon_v2@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::search::beacon_v2', 'y1_graph'=>'column'), 
	'seatchart'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::seatchart::avg_time||TY_Usage::resource::seatchart@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::resource::seatchart', 'y1_graph'=>'column'),
	'seatchart2'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::seatchart2::avg_time||TY_Usage::resource2::seatchart@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::resource2::seatchart', 'y1_graph'=>'column'),
	'session'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::session::avg_time||TY_Usage::checkout::session@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::checkout::session', 'y1_graph'=>'column'), 
	'saveJourney'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::saveJourney::avg_time||TY_Usage::checkout::saveJourney@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::checkout::saveJourney', 'y1_graph'=>'column'),
	'transaction_save'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::transaction_save::avg_time||TY_Usage::checkout::transaction_save@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::checkout::transaction_save', 'y1_graph'=>'column'),
	'submit+retry'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::submit+retry::avg_time||TY_Usage::checkout::submit@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::checkout::submit', 'y1_graph'=>'column'),
	'transaction_chk'=>array('apply_func'=>'average', 'apply_data'=>'TY_Response::transaction_chk::avg_time||TY_Usage::checkout::transaction_chk@@y1', 'y_axis_title' => 'Seconds', 'avg_table'=>true, 'extra_y'=>1, 'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::checkout::transaction_chk', 'y1_graph'=>'column'),
	'search_cache'=>array(
		'avg_table'=>true, 'total_table'=>true, 'apply_func'=>'average', 'apply_data'=>'function::y_splitter::avg_LT<0.5@@y3||TY_Response::search_cache::LT<0.5 ## function::y_splitter::avg_1.0=<1.5@@y3||TY_Response::search_cache::1.0=<1.5 ## function::y_splitter::avg_2.0=<3.0@@y3||TY_Response::search_cache::2.0=<3.0 ## function::y_splitter::avg_GT>3.0@@y3||TY_Response::search_cache::GT>3.0',
		'y_axis_title' => 'counts', 'extra_y'=>3, 
		'y1_axis_title' => $config['y_axis_title'], 'y1_data'=>'TY_Usage::search::total', 'y1_graph'=>'column', 'y1_color'=>'black',
		'y2_axis_title' => 'LT<0.5 %', 'y2_data_func'=>'percentage', 'y2_data'=>'TY_Usage::search::total@@y1||TY_Response::search_cache::LT<0.5', 'y2_graph'=>'spline', 'y2_color'=>'white', 'y2_dashStyle' => 'ShortDashDot',
		'y3_axis_title' => 'avg_x secs', 'y3_data_func'=>'y_splitter', 'y3_data' => 'avg_', 'y3_graph'=>'spline', 'y3_dashStyle' => 'shortdot', 'y3_color_split' => true
	)
);

$config['projects']['TY_SEO'] = array(
	'bot-google'=>array('pie'=>true, 'total_table'=>true), 
	'organic-google'=>array('pie'=>true, 'total_table'=>true),
	'sem'=>array('pie'=>true, 'total_table'=>true),
	'total'=>array('pie'=>true, 'total_table'=>true)
);

$config['projects']['TY_Errors'] = array();
$config['projects']['TY_Reports'] = array();
$config['projects']['GDS_Usage'] = array();
$config['projects']['GDS_Response'] = array();
$config['projects']['GDS_Errors'] = array();
