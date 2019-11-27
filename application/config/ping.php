<?php
$config['ping_interval'] = 5; //time partition... in minutes eg: 5 10 15 20 30 60 are ideal... if 5.. it takes log for previous 5 min set, eg: at 5:26 to 5:30, ts_end will be 5:25 (ts_start 5:20)
// if the number is big say 30, data will be 6 times less if its 5, set it based on your requiremenmt

$config['buffer_time'] = 220; // secs 

$config['tmp_table'] = 0; // in live seamless - it shd be zero

if(ENV == 'dev') {
	$config['pong_url'] = 'http://lazygraph.com/pong/'; // end it with the /
	$config['log_file_path'] = '/mnt/www/test/ty-acs-20121128';
} elseif(ENV == 'prd'){
	$config['pong_url'] = 'http://lazygraph.tinybag.biz/pong/';
	$config['log_file_path'] = '/var/log/httpd/ty-access_log';
}

//$config['log_format']['ts'] = 11;
$config['log_read_by_ts'] = "awk '$11 >= {ts_start} && $11 < {ts_end}' {input_file}"; // weblog... 11th position is the timestamp in my log

$config['applog_read_by_ts'] = "awk '$5 >= {ts_start} && $5 < {ts_end}' {input_file}";

$config['server_id'] = 'S2'; // it shd get change in every server, if not per server data required then ignore

//$5 is my request_url position, $11 is my unix_ts position
// project/type - chars - 20
// element - chars - 30
// projects must be defined in the server app config, to feed data
// make sure element names are unique inside a project/type
// dont use "::" inside project/type/element names 
// maybe its a good idea to not fix the elements inside a project/type, and fix it at the app config ? pros/cons r there

$config['projects']['TY_Usage'] = array(
	'homepage' => array(
		'elements' => array(
			//'hp' => "awk '$5 ~ /\/$/' {input_file} | wc -l", // rules
			'direct' => "awk '$5 ~ /^\/$/ && $1 != \"216.12.192.198\" && $7 == 200 && $13 ~/\"-\"/' {input_file} | wc -l",
			'google' => "awk '$5 ~ /^\/$/ && $13 ~/^\"http.?:\/\/www.google/' {input_file} | wc -l",
			'ty' => "awk '$5 ~ /^\/$/ && $13 ~/^\"http.?:\/\/www.travelyaari/' {input_file} | wc -l", 
			'ad_gclid' => "awk '$5 ~ /^\/\?gclid=/' {input_file} | wc -l",
			'mobile_ty' => "awk '$5 ~ /^\/$/ && $13 ~/^\"http.?:\/\/m\.travelyaari/' {input_file} | wc -l",
			'other' => "awk '($5 ~ /^\/\?.+/ || ($5 ~ /\/$/ && $13 !~/\"-\"/)) && $5 !~/\?gclid/ && $13 !~/^\"http.?:\/\/(www|m).(travelyaari|google)/' {input_file} | wc -l"
		)
		
	), // types
	'search' => array(
		'elements' => array(
			'total' => "awk '$5 ~ /\/search.+/' {input_file} | wc -l", // rules
			'total_v1' => "awk '$5 ~ /^\/search.+/' {input_file} | wc -l", // rules
			'total_v2' => "awk '$5 ~ /^\/ty2\/search.+/' {input_file} | wc -l", // rules
			'beacon_v1' => "awk '$5 ~ /beacon.gif.+page=search_v1.+category=load/' {input_file} | wc -l",
			'beacon_v2' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=load/' {input_file} | wc -l", 
			'no-result_v2' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=search_no_result_v2/' {input_file} | wc -l",
			'error_v2' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=search_error_v2/' {input_file} | wc -l",
			'served' => "awk '$5 ~ /\/search.+/ && $7 == 200' {input_file} | wc -l",
			'gclid' => "awk '$5 ~ /\/search.+gclid=.+/' {input_file} | wc -l",
			'src_h' => "awk '$5 ~/\/search.+src=h/' {input_file} | wc -l",
			'src_pd' => "awk '$5 ~/\/search.+src=pd/' {input_file} | wc -l",
			'src_nd' => "awk '$5 ~/\/search.+src=nd/' {input_file} | wc -l",
			'src_ms' => "awk '$5 ~/\/search.+src=ms/' {input_file} | wc -l",
			'src_nr' => "awk '$5 ~/\/search.+src=nr/' {input_file} | wc -l",
			'src_seo' => "awk '$5 ~/^\/search.+src=seo/' {input_file} | wc -l",
			'src_seo_v2' => "awk '$5 ~/^\/ty2\/search.+src=seo/' {input_file} | wc -l",
			'src_chk' => "awk '$5 ~/\/search.+src=chk/' {input_file} | wc -l",
			//'src_pgfail' => "awk '$5 ~/\/search.+src=pgfail/' {input_file} | wc -l",
			'known_bots' => "awk '$5 ~ /\/search.+/ && ($13 $14 $15 $16 $17 $18 ~ /(bot|baidu|alexa)/ )' {input_file} | wc -l"
			//'cb_payu' => "awk '$5 ~ /\/search\/callback\/payu/ && $7 == 302' {input_file} | wc -l"
		)
	),
	'checkout' => array(
		'elements' => array(
			'beacon' => "awk '$5 ~ /beacon.gif.+page=checkout/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l",
			'transaction_save' => "awk '$5 ~ /\/api\/transaction\/save/ && $4 ~ /POST/' {input_file} | wc -l",
			'saveJourney' => "awk '$5 ~ /\/checkout\/saveJourney/ && $4 ~ /POST/' {input_file} | wc -l",
			'session' => "awk '$5 ~ /^\/checkout\/session\// && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l",
			'session_uniq' => "awk '$5 ~ /^\/checkout\/session\// && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {split($5, s,\"/\");print s[4]}' {input_file} |sort|uniq|wc -l",
			'ty2_session_uniq' => "awk '$5 ~ /^\/ty2\/checkout\/session\// && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {split($5, s,\"/\");print s[5]}' {input_file} |sort|uniq|wc -l",
			'submit' => "awk '$5 ~ /\/checkout\/submit(\?|\/\?)/ && $4 ~/\"POST/ && $13 !~/punbus/' {input_file} | wc -l",
			'transaction_chk' => "awk '$5 ~ /\/api\/transaction\/checkout/ && $4 ~/\"POST/ && $13 !~/affiliate/' {input_file} | wc -l",
			'coupon_v2' => "awk '$5 ~ /\/api\/transaction\/applyCoupon/ && $4 ~/\"POST/' {input_file} | wc -l",
			'coupon_v1' => "awk '$5 ~ /\/resource\/validateCoupon/ && $4 ~/\"POST/' {input_file} | wc -l",
			'submitRetry' => "awk '$5 ~ /\/checkout\/submitRetry/ && $4 ~/\"POST/' {input_file} | wc -l",
			'submitRetry_v2' => "awk '$5 ~ /\/api\/transaction\/checkout.+holdretry/ && $4 ~/\"POST/' {input_file} | wc -l",
			'beacon_submitRetry' => "awk '$5 ~ /beacon.gif.+page=submitRetry/' {input_file} | wc -l",
			'submit_err' => "awk '$5 ~ /\/checkout\/submit(\?|\/\?)/ && $4 ~/POST/ && $7 != 200' {input_file} | wc -l",
			//'submitRetry_err' => "awk '$5 ~ /\/checkout\/submitRetry/ && $7 != 200' {input_file} | wc -l",
			'trans_chk_err' => "awk '$5 ~ /\/api\/transaction\/checkout/ && $4 ~/POST/ && $7 != 200' {input_file} | wc -l"
			//'chk_punbus' => "awk '$5 ~ /\/checkout\/submit(|\/)\?.+/ && $4 ~/\"POST/ && $13 ~/punbus/' {input_file} | wc -l"
		)
	),
	'checkout2search' => array(
		'elements' => array(
			'total_err' => "awk '$5 ~ /\/search.+ref=checkout2/' {input_file} | wc -l", // name bad
			'holdfailgds' => "awk '$5 ~ /\/search.+ref=checkout2.+reason=holdfailgds/' {input_file} | wc -l",
			'holdfailsoap' => "awk '$5 ~ /\/search\?.+ref=checkout2.+reason=holdfailexcp/' {input_file} | wc -l",
			'validation' => "awk '$5 ~ /\/search\?.+ref=checkout2.+reason=validatefail/' {input_file} | wc -l",
			'roundtrip' => "awk '$5 ~ /\/search\?.+ref=checkout.+reason=roundtrip/' {input_file} | wc -l",
			'roundtrip_uniq' => "awk '$5 ~ /^\/search.?\?returnJourney=/ {split($5, s,\"=\");print s[2]}' {input_file} | sort|uniq|wc -l"
		)
	),
	'payment' => array(
		'elements' => array(
			'callback_total' => "awk '$5 ~ /\/payment\/callback/' {input_file} | wc -l",
			'cb_payu' => "awk '$5 ~ /\/payment\/callback\/payu/' {input_file} | wc -l",
			'cb_ccave' => "awk '$5 ~ /\/payment\/callback\/ccavenue/' {input_file} | wc -l",
			'cb_pz' => "awk '$5 ~ /\/payment\/callback\/payzippy/' {input_file} | wc -l"
			//'cb_ebs' => "awk '$5 ~ /\/payment\/callback\/ebs/' {input_file} | wc -l",
			//'cb_tpsl' => "awk '$5 ~ /\/payment\/callback\/tpsl/' {input_file} | wc -l"

		)
	),
	'ticket' => array(
		'elements' => array(
			'booked_uniq' => "awk '$5 ~ /\/ticket\/booked\// {print $5}' {input_file} | sort|uniq | wc -l"
		)
	),
	'resource' => array(
		'elements' => array(
			'seatchart' => "awk '$5 ~ /\/resource\/GetSeatArrangement/ && $4 ~/POST/' {input_file} | wc -l",
			'seatchart_redir' => "awk '$5 ~ /\/resource\/GetSeatArrangement/ && $4 ~/POST/ && $7 == 302' {input_file} | wc -l",
			'seatchart_err' => "awk '$5 ~ /\/resource\/GetSeatArrangement/ && $7==200 && $9 <1000' {input_file} | wc -l",
			'routeinfo' => "awk '$5 ~ /\/resource\/GetRouteInfo/ && $7 == 200' {input_file} | wc -l"
		)
	),
	'resource2' => array(
		'elements' => array(
			'seatchart' => "awk '$5 ~ /\/api\/resource\/seatChartWithPickups/' {input_file} | wc -l",
			'seat_click' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=select_seats_v2/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l",
			'seat_load' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=seatchart_success_v2/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l",
			'seat_error' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=seatchart_error_v2/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l",
			'seat_val_error' => "awk '$5 ~ /beacon.gif.+page=search_v2.+category=seatchart_validation_error_v2/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/)' {input_file} | wc -l"
		)
	)
);

$config['projects_day']['TY_UniqueUsers'] = array(
	'ty' => array(
		'elements' => array(
			'all' => "awk '($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'home' => "awk '$5 ~ /beacon.gif.+page=home/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'search' => "awk '$5 ~ /\/search.+/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'seatchart_1' => "awk '$5 ~ /\/resource\/GetSeatArrangement/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'seatchart_2' => "awk '$5 ~ /\/resource\/seatChartWithPickups/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'checkout' => "awk '$5 ~ /\/checkout\/session/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'ticket_book' => "awk '$5 ~ /\/ticket\/booked/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l"
			//'search_beacon' => "awk '$5 ~/beacon.gif.+page=search/ && ($14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l"

		)
	)/*,
	'checkout' => array(
		'elements' => array(
			'saveJourney' => "awk '$5 ~ /\/checkout\/saveJourney/ {print $12}' {input_file} |sort|uniq | wc -l",
			'session' => "awk '$5 ~ /^\/checkout\/session/ && ($13 $14 $15 $16 $17 $18 !~ /(bot|baidu|alexa)/) {print $12}' {input_file} |sort|uniq | wc -l",
			'submit' => "awk '$5 ~ /\/checkout\/submit(\?|\/\?)/ && $4 ~/\"POST/ && $13 !~/punbus/ {print $12}' {input_file} |sort|uniq | wc -l",
			'submitRetry' => "awk '$5 ~ /\/checkout\/submitRetry/ && $4 ~/\"POST/ {print $12}' {input_file} |sort|uniq | wc -l"
		)
	)*/
);
// awk - division by zero error may apear here, can be ignored
$config['projects']['TY_Response'] = array(
	'search' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/search\?.+/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	), 
	'search2' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/api\/search.+/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	), 
	'seatchart' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/resource\/GetSeatArrangement/ && $4 ~/\"POST/ && $7 == 200' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'seatchart2' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/api\/resource\/seatChartWithPickups/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'session' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /^\/checkout\/session\//' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'saveJourney' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /^\/checkout\/saveJourney/ && $4 ~ /POST/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'transaction_save' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/api\/transaction\/save/ && $4 ~ /POST/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'submit+retry' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/checkout\/submit/ && $4 ~/\"POST/ && $13 !~/punbus/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'transaction_chk' => array(
		'elements' => array('avg_time' => "awk '$5 ~ /\/api\/transaction\/checkout/ && $4 ~ /POST/' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'")
	),
	'search_cache' => array(
		'elements' => array(
			'LT<0.5' => "awk '$5 ~ /\/api\/search.+/ && $8 < 500000' {input_file} | wc -l",
			'0.5=<1.0' => "awk '$5 ~ /\/api\/search.+/ && $8 < 1000000 && $8 >= 500000' {input_file} | wc -l",
			'1.0=<1.5' => "awk '$5 ~ /\/api\/search.+/ && $8 < 1500000 && $8 >= 1000000' {input_file} | wc -l",
			'1.5=<2.0' => "awk '$5 ~ /\/api\/search.+/ && $8 < 2000000 && $8 >= 1500000' {input_file} | wc -l",
			'2.0=<3.0' => "awk '$5 ~ /\/api\/search.+/ && $8 < 3000000 && $8 >= 2000000' {input_file} | wc -l",
			'GT>3.0' => "awk '$5 ~ /\/api\/search.+/ && $8 >= 3000000' {input_file} | wc -l",
			'avg_LT<0.5' => "awk '$5 ~ /\/api\/search.+/ && $8 < 500000' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'",
			'avg_1.0=<1.5' => "awk '$5 ~ /\/api\/search.+/ && $8 < 1500000 && $8 >= 1000000' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'",
			'avg_2.0=<3.0' => "awk '$5 ~ /\/api\/search.+/ && $8 < 3000000 && $8 >= 2000000' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'",
			'avg_GT>3.0' => "awk '$5 ~ /\/api\/search.+/ && $8 >= 3000000' {input_file} | awk '{sum+=$8}END{printf \"%.3f\",sum/1000000}'"
		)
	)
);

$config['projects']['TY_SEO'] = array(
	'bot-google' => array(
		'elements' => array(
			'ops' => "awk '$5 ~/bus-booking.+-online.html/ && $7 == 200 && $16 ~/Googlebot/' {input_file} | wc -l",
			'route' => "awk '$5 ~/bus-booking.+-to-.+-tickets.html/ && $7 == 200 && $16 ~/Googlebot/' {input_file} | wc -l",
			'city' => "awk '$5 ~/bus-booking.+-service.html/ && $7 == 200 && $16 ~/Googlebot/' {input_file} | wc -l",
			'ops-route' => "awk '$5 ~/bus-booking.+-to-.+.html/ && $5 !~/tickets/ && $7 == 200 && $16 ~/Googlebot/' {input_file} | wc -l",
			'ops-city' => "awk '$5 ~/bus-booking.+.html/ && $5 !~/(to|online|service|tickets)/ && $7 == 200 && $16 ~/Googlebot/' {input_file} | wc -l",
			'redirects' => "awk '$5 ~/bus-booking/ && $7 ~/(301|302)/ && $16 ~/Googlebot/' {input_file} | wc -l"
		)
	),
	'organic-google' => array(
		'elements' => array(
			'ops' => "awk '$5 ~/bus-booking.+-online.html/ && $5 !~/gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'route' => "awk '$5 ~/bus-booking.+-to-.+-tickets.html/ && $5 !~/gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'city' => "awk '$5 ~/bus-booking.+-service.html/ && $5 !~/gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'ops-route' => "awk '$5 ~/bus-booking.+-to-.+.html/ && $5 !~/(tickets|gclid)/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'ops-city' => "awk '$5 ~/bus-booking.+.html/ && $5 !~/(to|online|service|tickets|gclid)/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'redirects' => "awk '$5 ~/bus-booking/ && $5 !~/gclid/ && $7 ~/(301|302)/ && $13 ~/google/' {input_file} | wc -l"
		)
	),
	'sem' => array(
		'elements' => array(
			'ops' => "awk '$5 ~/bus-booking.+-online.html.+gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'route' => "awk '$5 ~/bus-booking.+-to-.+-tickets.html.+gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'city' => "awk '$5 ~/bus-booking.+-service.html.+gclid/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'ops-route' => "awk '$5 ~/bus-booking.+-to-.+.html.+gclid/ && $5 !~/(tickets)/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'ops-city' => "awk '$5 ~/bus-booking.+.html.+gclid/ && $5 !~/(to|online|service|tickets)/ && $7 == 200 && $13 ~/google/' {input_file} | wc -l",
			'redirects' => "awk '$5 ~/bus-booking.+gclid/ && $7 ~/(301|302)/ && $13 ~/google/' {input_file} | wc -l"
		)
	),
	'total' => array(
		'elements' => array(
			'ops' => "awk '$5 ~/bus-booking.+-online.html/ && $7 == 200' {input_file} | wc -l",
			'route' => "awk '$5 ~/bus-booking.+-to-.+-tickets.html/ && $7 == 200' {input_file} | wc -l",
			'city' => "awk '$5 ~/bus-booking.+-service.html/ && $7 == 200' {input_file} | wc -l",
			'ops-route' => "awk '$5 ~/bus-booking.+-to-.+.html/ && $5 !~/tickets/ && $7 == 200' {input_file} | wc -l",
			'ops-city' => "awk '$5 ~/bus-booking.+.html/ && $5 !~/(to|online|service|tickets)/ && $7 == 200' {input_file} | wc -l",
			'redirects' => "awk '$5 ~/bus-booking/ && $7 ~/(301|302)/' {input_file} | wc -l"
		)
	)
);


//$config['projects']['TY_Errors'] = array( );
//$config['projects']['GDS_Response'] = array();
//$config['projects']['GDS_Errors'] = array();