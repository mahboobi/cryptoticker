<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| USER AGENT TYPES
| -------------------------------------------------------------------
| This file contains four arrays of user agent data.  It is used by the
| User Agent Class to help identify browser, platform, robot, and
| mobile device data.  The array keys are used to identify the device
| and the array values are used to set the actual name of the item.
|
*/

$platforms = array (
					'windows nt 6.0'	=> 'Windows Longhorn',
					'windows nt 5.2'	=> 'Windows 2003',
					'windows nt 5.0'	=> 'Windows 2000',
					'windows nt 5.1'	=> 'Windows XP',
					'windows nt 4.0'	=> 'Windows NT 4.0',
					'winnt4.0'			=> 'Windows NT 4.0',
					'winnt 4.0'			=> 'Windows NT',
					'winnt'				=> 'Windows NT',
					'windows 98'		=> 'Windows 98',
					'win98'				=> 'Windows 98',
					'windows 95'		=> 'Windows 95',
					'win95'				=> 'Windows 95',
					'windows'			=> 'Unknown Windows OS',
					'os x'				=> 'Mac OS X',
					'ppc mac'			=> 'Power PC Mac',
					'freebsd'			=> 'FreeBSD',
					'ppc'				=> 'Macintosh',
					'linux'				=> 'Linux',
					'debian'			=> 'Debian',
					'sunos'				=> 'Sun Solaris',
					'beos'				=> 'BeOS',
					'apachebench'		=> 'ApacheBench',
					'aix'				=> 'AIX',
					'irix'				=> 'Irix',
					'osf'				=> 'DEC OSF',
					'hp-ux'				=> 'HP-UX',
					'netbsd'			=> 'NetBSD',
					'bsdi'				=> 'BSDi',
					'openbsd'			=> 'OpenBSD',
					'gnu'				=> 'GNU/Linux',
					'unix'				=> 'Unknown Unix OS'
				);


// The order of this array should NOT be changed. Many browsers return
// multiple browser types so we want to identify the sub-type first.
$browsers = array(
					'Flock'				=> 'Flock',
					'Chrome'			=> 'Chrome',
					'Opera'				=> 'Opera',
					'MSIE'				=> 'Internet Explorer',
					'Internet Explorer'	=> 'Internet Explorer',
					'Shiira'			=> 'Shiira',
					'Firefox'			=> 'Firefox',
					'Chimera'			=> 'Chimera',
					'Phoenix'			=> 'Phoenix',
					'Firebird'			=> 'Firebird',
					'Camino'			=> 'Camino',
					'Netscape'			=> 'Netscape',
					'OmniWeb'			=> 'OmniWeb',
					'Safari'			=> 'Safari',
					'Mozilla'			=> 'Mozilla',
					'Konqueror'			=> 'Konqueror',
					'icab'				=> 'iCab',
					'Lynx'				=> 'Lynx',
					'Links'				=> 'Links',
					'hotjava'			=> 'HotJava',
					'amaya'				=> 'Amaya',
					'IBrowse'			=> 'IBrowse'
				);

$mobiles = array(
					// legacy array, old values commented out
					'mobileexplorer'	=> 'Mobile Explorer',
//					'openwave'			=> 'Open Wave',
//					'opera mini'		=> 'Opera Mini',
//					'operamini'			=> 'Opera Mini',
//					'elaine'			=> 'Palm',
					'palmsource'		=> 'Palm',
//					'digital paths'		=> 'Palm',
//					'avantgo'			=> 'Avantgo',
//					'xiino'				=> 'Xiino',
					'palmscape'			=> 'Palmscape',
//					'nokia'				=> 'Nokia',
//					'ericsson'			=> 'Ericsson',
//					'blackberry'		=> 'BlackBerry',
//					'motorola'			=> 'Motorola'

					// Phones and Manufacturers
					'motorola'			=> "Motorola",
					'nokia'				=> "Nokia",
					'palm'				=> "Palm",
					'iphone'			=> "Apple iPhone",
					'ipad'				=> "iPad",
					'ipod'				=> "Apple iPod Touch",
					'sony'				=> "Sony Ericsson",
					'ericsson'			=> "Sony Ericsson",
					'blackberry'		=> "BlackBerry",
					'cocoon'			=> "O2 Cocoon",
					'blazer'			=> "Treo",
					'lg'				=> "LG",
					'amoi'				=> "Amoi",
					'xda'				=> "XDA",
					'mda'				=> "MDA",
					'vario'				=> "Vario",
					'htc'				=> "HTC",
					'samsung'			=> "Samsung",
					'sharp'				=> "Sharp",
					'sie-'				=> "Siemens",
					'alcatel'			=> "Alcatel",
					'benq'				=> "BenQ",
					'ipaq'				=> "HP iPaq",
					'mot-'				=> "Motorola",
					'playstation portable'	=> "PlayStation Portable",
					'hiptop'			=> "Danger Hiptop",
					'nec-'				=> "NEC",
					'panasonic'			=> "Panasonic",
					'philips'			=> "Philips",
					'sagem'				=> "Sagem",
					'sanyo'				=> "Sanyo",
					'spv'				=> "SPV",
					'zte'				=> "ZTE",
					'sendo'				=> "Sendo",

					// Operating Systems
					'symbian'				=> "Symbian",
					'SymbianOS'				=> "SymbianOS",
					'elaine'				=> "Palm",
					'palm'					=> "Palm",
					'series60'				=> "Symbian S60",
					'windows ce'			=> "Windows CE",

					// Browsers
					'obigo'					=> "Obigo",
					'netfront'				=> "Netfront Browser",
					'openwave'				=> "Openwave Browser",
					'mobilexplorer'			=> "Mobile Explorer",
					'operamini'				=> "Opera Mini",
					'opera mini'			=> "Opera Mini",

					// Other
					'digital paths'			=> "Digital Paths",
					'avantgo'				=> "AvantGo",
					'xiino'					=> "Xiino",
					'novarra'				=> "Novarra Transcoder",
					'vodafone'				=> "Vodafone",
					'docomo'				=> "NTT DoCoMo",
					'o2'					=> "O2",

					// Fallback
					'mobile'				=> "Generic Mobile",
					'wireless'				=> "Generic Mobile",
					'j2me'					=> "Generic Mobile",
					'midp'					=> "Generic Mobile",
					'cldc'					=> "Generic Mobile",
					'up.link'				=> "Generic Mobile",
					'up.browser'			=> "Generic Mobile",
					'smartphone'			=> "Generic Mobile",
					'cellphone'				=> "Generic Mobile"
				);

// There are hundreds of bots but these are the most common.
$robots = array(
					'googlebot'			=> 'Googlebot',
					'msnbot'			=> 'MSNBot',
					'slurp'				=> 'Inktomi Slurp',
					'yahoo'				=> 'Yahoo',
					'askjeeves'			=> 'AskJeeves',
					'fastcrawler'		=> 'FastCrawler',
					'infoseek'			=> 'InfoSeek Robot 1.0',
					'lycos'				=> 'Lycos'
				);

/* End of file user_agents.php */
/* Location: ./application/config/user_agents.php */

-----------

public static double findMedianSortedArrays(int A[], int B[]) {
    int m = A.length;
    int n = B.length;

    if ((m + n) % 2 != 0) // odd
        return (double) findKth(A, B, (m + n) / 2, 0, m - 1, 0, n - 1);
    else { // even
        return (findKth(A, B, (m + n) / 2, 0, m - 1, 0, n - 1) 
            + findKth(A, B, (m + n) / 2 - 1, 0, m - 1, 0, n - 1)) * 0.5;
    }
}

public static int findKth(int A[], int B[], int k, 
    int aStart, int aEnd, int bStart, int bEnd) {

    int aLen = aEnd - aStart + 1;
    int bLen = bEnd - bStart + 1;

    // Handle special cases
    if (aLen == 0)
        return B[bStart + k];
    if (bLen == 0)
        return A[aStart + k];
    if (k == 0)
        return A[aStart] < B[bStart] ? A[aStart] : B[bStart];

    int aMid = aLen * k / (aLen + bLen); // a's middle count
    int bMid = k - aMid - 1; // b's middle count

    // make aMid and bMid to be array index
    aMid = aMid + aStart;
    bMid = bMid + bStart;

    if (A[aMid] > B[bMid]) {
        k = k - (bMid - bStart + 1);
        aEnd = aMid;
        bStart = bMid + 1;
    } else {
        k = k - (aMid - aStart + 1);
        bEnd = bMid;
        aStart = aMid + 1;
    }

    return findKth(A, B, k, aStart, aEnd, bStart, bEnd);
}

--------------
let bubbleSort = (arr, cmp = compare) => {
  for (let i = 0; i < arr.length; i++) {
    for (let j = i; j > 0; j--) {
      if (cmp(arr[j], arr[j - 1]) < 0) {
        [arr[j], arr[j - 1]] = [arr[j - 1], arr[j]];
      }
    }
  }
  return arr;
};

let insertionSort = (arr) => {
    for (let i = 0; i < a.length; i++) {
        let toCmp = arr[i];
        for (let j = i; j > 0 && toCmp < a[j - 1]; j--)
            arr[j] = a[j - 1];
        arr[j] = toCmp;
    }
    return arr;
}

var selectionSort = function (arr) {
  let i,m,j;
  for (i = -1; ++i < a.length;) {
    for (m = j = i; ++j < a.length;) {
      if (arr[m] > arr[j]) m = j;
    }
    [arr[m], arr[i]] = [arr[i], arr[m]];
 }
 return arr;
}

==========
let mergeSort = (arr) => {

  if (arr.length < 2) return arr;

  let middle = parseInt(arr.length / 2),
  left = arr.slice(0, middle),
  right = arr.slice(middle);

  return merge(mergeSort(left), mergeSort(right));
}

let merge = (left, right) => {
  let result = [];

  while (left.length && right.length) {
    left[0] <= right[0] ?
    result.push(left.shift()) :
    result.push(right.shift());
  }

  while (left.length) result.push(left.shift());
  while (right.length) result.push(right.shift());

  return result;
}
=========

let quicksort = function(arr) {
  if(arr.length <= 1) return arr;

  let pivot = Math.floor((arr.length -1)/2);
  let val = arr[pivot], less = [], more = [];

  arr.splice(pivot, 1);
  arr.forEach(function(e,i,a){
    e < val ? less.push(e) : more.push(e);
  });

  return (quicksort(less)).concat([val],quicksort(more))
}

-------------------

function merge_sort(&$list){
    if( count($list) <= 1 ){
        return $list;
    }

    $left =  array();
    $right = array();

    $middle = (int) ( count($list)/2 );

    // Make left
    for( $i=0; $i < $middle; $i++ ){
        $left[] = $list[$i];
    }

    // Make right
    for( $i = $middle; $i < count($list); $i++ ){
        $right[] = $list[$i];
    }

    // Merge sort left & right
    merge_sort($left);
    merge_sort($right);

    // Merge left & right
    return merge($left, $right);
}

function merge(&$left, &$right){
    $result = array();

    while(count($left) > 0 || count(right) > 0){
        if(count($left) > 0 && count(right) > 0){
            if($left[0] <= $right[0]){
                $result[] = array_shift($left);
            } else {
                $result[] = array_shift($right);
            }
        } elseif (count($left) > 0){
            $result[] = array_shift($left);
        } elseif (count($right) > 0){
            $result[] = array_shift($right);
        }
    }

    print_array($result);exit;

    return $result;
}

------------

function quick_sort($array)
{
    // find array size
    $length = count($array);
    
    // base case test, if array of length 0 then just return array to caller
    if($length <= 1){
        return $array;
    }
    else{
    
        // select an item to act as our pivot point, since list is unsorted first position is easiest
        $pivot = $array[0];
        
        // declare our two arrays to act as partitions
        $left = $right = array();
        
        // loop and compare each item in the array to the pivot value, place item in appropriate partition
        for($i = 1; $i < count($array); $i++)
        {
            if($array[$i] < $pivot){
                $left[] = $array[$i];
            }
            else{
                $right[] = $array[$i];
            }
        }
        
        // use recursion to now sort the left and right lists
        return array_merge(quick_sort($left), array($pivot), quick_sort($right));
    }
}

----------------

function mergeSort($array)
{
    if(count($array) == 1 )
    {
        return $array;
    }

    $mid = count($array) / 2;
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);
    $left = mergeSort($left);
    $right = mergeSort($right);

    return merge($left, $right);
}


function merge($left, $right)
{
    $res = array();

    while (count($left) > 0 && count($right) > 0)
    {
        if($left[0] > $right[0])
        {
            $res[] = $right[0];
            $right = array_slice($right , 1);
        }
        else
        {
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }
    }

    while (count($left) > 0)
    {
        $res[] = $left[0];
        $left = array_slice($left, 1);
    }

    while (count($right) > 0)
    {
        $res[] = $right[0];
        $right = array_slice($right, 1);
    }

    return $res;
}

----------

function binary_search(array $a, $first, $last, $key, $compare) {
        $lo = $first; 
        $hi = $last - 1;
 
        while ($lo <= $hi) {
            $mid = (int)(($hi - $lo) / 2) + $lo;
            $cmp = call_user_func($compare, $a[$mid], $key);
 
            if ($cmp < 0) {
                $lo = $mid + 1;
            } elseif ($cmp > 0) {
                $hi = $mid - 1;
            } else {
                return $mid;
            }
        }
        return -($lo + 1);
    }

function cmp($a, $b) {
        return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
    }
 
    $a = array(1,2,3,4,5,6);
    $idx = binary_search($a, 0, sizeof($a), 4, 'cmp');

-----
bool CheckSubstring(std::string firstString, std::string secondString){
    if(secondString.size() > firstString.size())
        return false;

    for (int i = 0; i < firstString.size(); i++){
        int j = 0;
        if(firstString[i] == secondString[j]){
            while (firstString[i] == secondString[j] && j < secondString.size()){
                j++;
                i++;
            }

            if (j == secondString.size())
                    return true;
        }
    }
    return false;
}

-------

$img = array();
$img[0] = '100100';
$img[1] = '001010';
$img[2] = '000000';
$img[3] = '110000';
$img[4] = '111000';
$img[5] = '010100';


//print_r($img);


$distinct = 0;
$n = count($img);
$track = array();
for($i=0; $i<$n; $i++){
    $track[] = str_repeat('0', $n);
}

//print_r($track);

function mark($i, $j, &$track, $img){
    $track[$i]{$j} = 1;

    if(isset($img[$i]{$j+1}) && $img[$i]{$j+1} && !$track[$i]{$j+1}) 
        mark($i, $j+1, $track, $img);
    if(isset($img[$i]{$j-1}) && $img[$i]{$j-1} && !$track[$i]{$j-1}) 
        mark($i, $j-1, $track, $img);
    if(isset($img[$i+1]{$j}) && $img[$i+1]{$j} && !$track[$i+1]{$j}) 
        mark($i+1, $j, $track, $img);
    if(isset($img[$i-1]{$j}) && $img[$i-1]{$j} && !$track[$i-1]{$j}) 
        mark($i-1, $j, $track, $img);
    if(isset($img[$i+1]{$j-1}) && $img[$i+1]{$j-1} && !$track[$i+1]{$j-1}) 
        mark($i+1, $j-1, $track, $img);
    if(isset($img[$i-1]{$j+1}) && $img[$i-1]{$j+1} && !$track[$i-1]{$j+1}) 
        mark($i-1, $j+1, $track, $img);
    if(isset($img[$i-1]{$j-1}) && $img[$i-1]{$j-1} && !$track[$i-1]{$j-1}) 
        mark($i-1, $j-1, $track, $img);
    if(isset($img[$i+1]{$j+1}) && $img[$i+1]{$j+1} && !$track[$i+1]{$j+1}) 
        mark($i+1, $j+1, $track, $img);
}


for($i=0; $i<$n; $i++){
    for($j=0; $j<$n; $j++){
        if($track[$i]{$j} == 0 && $img[$i]{$j} == 1){ //print_r($track);
            mark($i, $j, $track, $img);
            $distinct++;
        }
        
    }
}

//print_r($img);
//print_r($track);
echo $distinct;
