<?php

function string_sort($str){
	$letters = str_split($str); natcasesort($letters);
    $ret = "";
    foreach($letters as $letter){
        $ret .= $letter;
    }
    return $ret;
}

function between($n, $range1, $range2){
	return $range1 <= $n && $n <= $range2 ? true : false;
}

function pr($str){
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function chkDir($path){
	$dir = realpath($path);
	if(!$dir) return mkdir($path, 0777);
	return is_dir($dir);
}
function is(& $v) {
	return isset ( $v ) && $v ? true : false;
}

function chk(& $v, $default = null){
	return isset ( $v ) ? $v : $default;
}

function issetArray(& $v){
	return isset ( $v ) && is_array($v) ? true : false;
}

function null2zero($v){
	return $v ? $v : 0;
}

function myID($type = 16) {
	$id = rand ( 10, 99 ) . time () . rand ( 1000, 9999 );
	if ($type == 18)
		$id = rand ( 10, 99 ) . $id;
	return $id;
}

function cleanPostData() {
	if ($_POST) {
		//$form = array();
		//print_r($_POST);
		foreach ( $_POST as $key => $value ) {
			if (! is_array ( $value ))
				$_POST [$key] = removeExtraSpace(cleanData ( $value )); // some more cleaning here?
		}
		//print_r($_POST);die();
	//return $form;
	}
}

function removeSpecialChars($value){
	$value = str_replace(array(',','.','_',"'", '"', '`', '!', '@', '#','$','%','^','&','*', '(',')', '[',']','{','}'), '', $value); // put a preg
	$value = removeExtraSpace($value);
	return strtolower(str_replace(' ', '_', $value));
}

function removeExtraSpace($str) {
	return preg_replace ( '/(  +)/', ' ', $str );
}

function removeExtraDash($str) {
	return preg_replace ( '/-+/', '-', $str );
}

function cleanData($value) { // clean of input textarea and meta tags.... dont forget
	//$value = strip_tags($value, '<a><font>');
	$find = array ('/\n\n\n\n+/' ); //, '/(\s\s+)|(\t\t+)/'
	$replace = array ("\n\n\n" ); //, ' '
	//return trim($value);
	return trim ( preg_replace ( $find, $replace, $value ) );
}

function makePrettyUrl($url, $length){
	$url = trim($url);
	$url = strtolower($url);
	//while(strpos($url, '  ') !== false)
		//$url = str_replace('  ', ' ', $url);
	//$url = removeExtraSpace($url);
	//$url = str_replace(' ', '-', $url);
	$url = preg_replace('/[^a-z0-9]/', '-', $url);
	$url = trim(removeExtraDash($url),'-');
	$url = trim(substr($url, 0, $length),'-');
	
	return $url;
}

function keyMaker($k, $type, $rootkey = false) { // this is for object caching and mainly memc caching
	$key = false;
	switch ($type) {
		
		case 'uid' :
			$key = 'U' . $k;
			break;
		case 'bkey' : 
			$key = $type .'_'. $rootkey .'_'. $k;
			break;
			
		case 'fbid':
			$key = 'FB' . $k;
			break;
		
		case 'fb_api':
			$key = 'FBA_'. $k; 
			break;
		
		case 'fb_obj':
			$key = 'FBO_'. $k;
			break;
		case 'sourceid': $key = 'S'.$k; break;
		default :
			$key = $type .'_'. $k;
			break;
	}
	return $key;
}

function fetchJsonFeed($url){
	$feed = fetchUrl($url);
	if($feed) $feed = json_decode($feed);
	return $feed;
}

function fetchUrl($url, $timeout = 15, $opt = false) {
	$ch = curl_init ();
	//curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	//curl_setopt($ch, CURLOPT_HEADER, 0);
	//curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, 1);
	//curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 1);
	//curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); // for proxy
	//curl_setopt($ch, CURLOPT_PROXY, 'http://10.80.2.13:80'); // for proxy
	curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
	if($opt && is_array($opt)) { 
		curl_setopt_array($ch, $opt);
	}
	$rs = curl_exec ( $ch );
	//$r = curl_getinfo($ch);
	curl_close ( $ch );
	//echo '<pre>';print_r($r);
	return $rs;
}

function postToUrl($url, $data, $timeout = 20) {
	if (is_array ( $data ) && ! empty ( $data ) && $url != '') {
		$curlPost = '';
		//foreach ( $data as $field => $value )
		//	$curlPost .= $field . '=' . urlencode ( $value ) . '&';
		//$curlPost = rtrim ( $curlPost, '&' );
		$curlPost = http_build_query($data);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout ); // 20 sec.. its too much
		$res = curl_exec ( $ch );
		curl_close ( $ch );
		return $res;
	}
	return false;
}

function getAllIndexFromChildArray($array, $key, $type = 'array', $reverse = false, $reverseValue = false) {
	$keys = array ();
	if ($array) {
		foreach ( $array as $k => $v ) {
			if ($type == 'array')
				if($reverse) $keys [$v [$key]] = $reverseValue === false ? $k : $v[$reverseValue];
				else $keys [$k] = $v [$key];
			elseif ($type == 'object')
				if($reverse) $keys [$v->$key] = $reverseValue === false ? $k : $v->$reverseValue; // ? $v->$key : $k;
				else $keys [$k] = $v->$key;
		}
	}
	return $keys;
}

function getIndexedArray($array, $key, $type = 'array') {
	if (empty ( $array ))
		return $array;
	$indexedArray = array ();
	if ($type == 'array') {
		foreach ( $array as $k => $v ) {
			$indexedArray [$v [$key]] = $v;
		}
	} elseif ($type == 'object') {
		foreach ( $array as $k => $v ) {
			$indexedArray [$v->$key] = $v;
		}
	}
	return $indexedArray;

}

function inArrayChildObject($needle, $array, $key, $type = 'object'){
	if(!$needle || !is_array($array) || !$key) return false;
	foreach($array as $k => $object){
		if($type == 'object'){
			if($object->$key == $needle) return true;
		} else {
			if($object[$key] == $needle) return true;
		}
	}
	return false;
}

function checkAndAddToList($item, $array){
	if(!$item) return array();
	if(!$array) return array($item);
	if(!is_array($array)){
		$array = explode(',', $array);
		if(!is_array($array)) return array($item);
	}
	if(in_array($item, $array)) return $array;
	$array[] = $item;
	return $array;
}

function addRecentList($item, $array, $count, $uniqueCheck = true){
	if($array && !is_array($array)) $array = explode(',', $array); 
	if(!$array) return array($item);
	if($uniqueCheck){
		$array = arrayDelete($array, $item);
	}
	if(count($array) > $count - 1) array_pop($array);
	array_unshift($array, $item);
	return $array;
}

function arrayDelete($array, $value = false, $key = false, $resetKey = true) {
	if (! $key){
		if(!is_array($value)) $key = array_search ( $value, $array );
		else $key = array_keys($array, $value);
	}
	if ($key !== false) {
		if(is_array($key)) {
			foreach ($key as $k) unset($array[$k]);
		} else {
			unset ( $array [$key] );
		}
		if ($resetKey)
			$array = array_values ( $array );
	}
	//print_r($array);
	return $array;
}

function childObjectDeleteInArray($array, $childKey, $childValues){
	if(!is_array($array)) return $array;
	foreach($array as $k => $a){
		if(!isset($childValues[$a->$childKey])) continue;
		unset($array[$k]);
	}
	return $array;
}

function simulatePost(){
		if(is_array($_GET))
			foreach($_GET as $k => $v)
				$_POST[$k] = $v;
	}
	
function getFileMimeType($filePath, $fromHeader = false) {
	// require to include FileFormatIdentifier lib before get called... not putting here
	if ($fromHeader)
		return FileFormatIdentifier::fromHeader ( $filePath );
	return FileFormatIdentifier::getMIMEType ( $filePath );
}

function timePassed($ts, $ref_ts = false){
	if(!$ref_ts) $ref_ts = time();
	$diff_ts = $ref_ts - $ts;
	$type = $diff_ts >= 0 ? 'past' : 'future';
	if($type == 'future') $diff_ts = $diff_ts * (-1);
	$min = 60;
	$hr = 3600;
	$day = 86400;
	$week = 604800;
	$month = 2592000;
	$year = 31104000;
	if($diff_ts < $min){
		$t = $diff_ts;
		$str =  $t . ' second';
	} elseif($diff_ts > $min && $diff_ts < $hr){
		$t = round($diff_ts / $min);
		$str = $t . ' minute';
	} elseif($diff_ts > $hr && $diff_ts < $day){
		$t = round($diff_ts / $hr);
		$str = $t . ' hour';
	} elseif($diff_ts > $day && $diff_ts < $month){
		$t = round($diff_ts / $day);
		$str = $t . ' day';
	} elseif($diff_ts > $month && $diff_ts < $year){
		$t = round($diff_ts / $week);
		$str = $t . ' week';
	} elseif($diff_ts > $year){
		$t = round($diff_ts / $month);
		$str = $t . ' month';
	}
	if($t > 1) $str .= 's';
	if($type == 'past') $str .= ' ago';
	return $str;
}

function isPlural($n){
	return $n > 1 ? 's' : '';
}

function trimString($string, $start = true, $uc = false) {
	mb_internal_encoding ( "UTF-8" );
	$string = trim ( $string );
	if ($uc == 'f')
		$string = ucfirst ( $string );
	else if ($uc == 'w')
		$string = ucwords ( $string );
	$strLen = mb_strlen ( $string ); // make it mb
	if ($strLen > ($start + 3)) {
		$string = mb_substr ( $string, 0, $start ) . '...';
	}
	return $string;
}

function add_http_in_url($url){
	return preg_match('/^http(s|):\/\//', $url) ? $url : 'http://'.$url;
}

function find_images_url($url){
	if(!$url) return false;
	ini_set ( 'include_path', ini_get ( 'include_path' ) . ';' . PATH_SEPARATOR . APPPATH . 'third_party' );
	require_once "cURL.php";
	$url = add_http_in_url($url);
	// before curl - chk header - if its an image
	$headers = get_headers($url, true);
	$image_mime_types = array('image/jpeg','image/png','image/gif','image/bmp', 'image/jpg'); // image/tif image/tga
	if($headers && isset($headers['Content-Type'])){
		$content_type = is_array($headers['Content-Type']) ? end($headers['Content-Type']) : $headers['Content-Type']; // its array when it gets redirected
		if(in_array(strtolower($content_type), $image_mime_types))
			return array('type'=>$headers['Content-Type'], 'images_count'=>1, 'images'=>array($url));
	}
	
	$curl = new Curl(1); // id can be session based
	$content = $curl->exec($url);
	$content_info = $curl->getInfo(); //pr($content_info);
	$curl->close();
	$content_type = strtolower($content_info['content_type']);
	if(strpos($content_type, 'text/html') !== false || in_array($content_type, array('text/xml', 'application/xml', 'text/plain'))) {
		$images = find_images_html($content);
		return array('type'=>$content_type, 'images_count'=>count($images), 'images'=>array_values($images));
	} elseif(in_array($content_type, $image_mime_types)) { 
		return array('type'=>$content_type, 'images_count'=>1, 'images'=>array($url));
	}
	return false;
}

function find_images_html($html){
	if(!$html) return array();
	$dom = new DOMDocument();
	@$dom->loadHTML( $html );
	$xml = simplexml_import_dom($dom);
	$images = $xml -> xpath('//img'); // /@src
	if($images){
		$imgs = array();
		//$f = '@attributes';
		foreach($images as $img){
			$img = current($img);
			$imgs[] = $img['src']; //$img->$f;
		}
		return array_unique($imgs);
	}
	return array();
}

function getFromGooglePlaceData($place, $field, $attr = false){
	switch($field){
		case 'place': return $place->name; break; // vicinity ?
		case 'state': 
			$return = findAddressComponentFromPlaceData($place, 'administrative_area_level_1');
			if($attr && $return && isset($return->$attr)) return $return->$attr;
			return $return;
			break;
		case 'country': // attr - short_name || long_name
			$return = findAddressComponentFromPlaceData($place, 'country');
			if($attr && $return && isset($return->$attr)) return $return->$attr;
			return $return;
			break;
	}
	return false;
}

function findAddressComponentFromPlaceData($place, $type){ // state - administrative_area_level_1
	$result = false;
	foreach($place->address_components as $ac){
		foreach($ac->types as $t){
			if($type == $t) {
				$result = $ac;
				break 2;
			}
		}
	}
	return $result;
}

function lat_long($lat_long_csv){
	if(!$lat_long_csv) return array(null, null);
	$lat_long = explode(',', $lat_long_csv);
	if($lat_long) return $lat_long;
	return array(null, null);
}

function displayDate($day, $month, $year, $hideYear = 0, $showDay = 0){
	$ts = mktime(1,1,1, $month, $day, $year);
	$dateFormat = 'jS F';
	if(!$hideYear) $dateFormat .= ', Y';
	if($showDay) $dateFormat = 'l, '.$dateFormat;
	return date($dateFormat, $ts);
}

function stringEndPart($haystack, $needle) { // inout: hello4hi, 4 ... output: hi
	$laststr = strstr ( $haystack, $needle );
	if ($laststr)
		return substr ( $laststr, 1 );
	return false;
}

function asyncFetchUrl($url, $timeout = 100, $returnTransfer = false)
{
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, $returnTransfer );
	curl_setopt ( $ch, CURLOPT_HEADER, 0);
	curl_setopt ( $ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt ( $ch, CURLOPT_TIMEOUT_MS, $timeout );
	curl_setopt( $ch, CURLOPT_NOSIGNAL, 1);
	$rs = curl_exec ( $ch );
	curl_close ( $ch );
	return $rs;
}

function memory_usage(){
	$m = memory_get_usage();
	$m1 = memory_get_usage(true);
	return $m / (1024 * 1024);
}

function closest($array, $number) {
    //does an exact match exist?
    if ($i=array_search($number, $array)) return $i;

    //find closest
    foreach ($array as $match) {
        $diff = abs($number-$match); //get absolute value of difference
        if (!isset($closeness) || (isset($closeness) && $closeness>$diff)) {
            $closeness = $diff;
            $closest = $match;
        }
    }
    return $closest;
}

?>