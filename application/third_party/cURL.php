<?php
/**
 * Class to handle cURL requests
 * 
 * @author Cyril Mazur	www.cyrilmazur.com	twitter.com/CyrilMazur	facebook.com/CyrilMazur
 */
class cURL {
	/**
	 * Contains the vars to send by POST
	 * @var array
	 */
	private $postVars;
	
	/**
	 * cURL handler
	 * @var ressource
	 */
	private $ch;
	
	/**
	 * The headers to send
	 * @var string
	 */
    private $headers;
	
	/**
	 * The number of the current channel
	 * @var int
	 */
	private $n;
	
	/**
	 * The resulted text
	 * @var string
	 */
	private $r_text;
	
	/**
	 * The resulted headers
	 * @var string
	 */
	private $r_headers;
	
	/**
	 * Constructor
	 */
	public function __construct($n = 0) {
		putenv('TZ=US/Pacific');
		
		$headers				= array();
		$headers['agent']		= 'User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)';
		$headers['cookie']		= '/tmp/curl/cookies/'.$n;
		$headers['randDate']	= mktime(0, 0, 0, date('m'), date('d') - rand(3,26),date('Y'));
		
		$this->n			= $n;
		$this->headers		= $headers;
		$this->postVars		= array();
		$this->ch			= curl_init();
	}
	
	/**
	 * Add post vars
	 * @param string $name
	 * @param stringe $value
	 */
	public function addPostVar($name,$value) {
		$this->postVars[$name] = $value;
	}
	
	/**
	 * Execute the request and return the result
	 * @param string $url
	 * @return string
	 */
	public function exec($url) {
		// Set the options
		curl_setopt ($this->ch, CURLOPT_URL,$url);
		curl_setopt ($this->ch, CURLOPT_USERAGENT, $this->headers['agent']);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, 0);
		curl_setopt ($this->ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt ($this->ch, CURLOPT_COOKIEJAR,  $this->headers['cookie']);
		curl_setopt ($this->ch, CURLOPT_COOKIEFILE,  $this->headers['cookie']);
		
		curl_setopt ($this->ch, CURLINFO_HEADER_OUT, true);
		//curl_setopt ($this->ch, CURLOPT_HEADER, true);
		
		// Send the POST vars
		if (sizeof($this->postVars) > 0) {
			$postVars = '';
			foreach($this->postVars as $name => $value) {
				$postVars .= $name.'='.$value.'&';
			}
			$postVars = substr($postVars,0,strlen($postVars)-1);
			
			curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $postVars);
			curl_setopt ($this->ch, CURLOPT_POST, 1);
		}
		
		// Execute and retrieve the result
		$t = ''; $i =0;
		while ($t == '') { $i++;
			$t = curl_exec($this->ch);
			if($i > 2) break;
		}
		
		$this->r_text		= $t;
		$this->r_headers	= curl_getinfo($this->ch,CURLINFO_HEADER_OUT);
		
		return $this->r_text;
	}
	
	/**
	 * Return the resulted text
	 * @return string
	 */
	public function getResult() {
		return $this->r_text;
	}
	
	/**
	 * Return the headers
	 *
	 * @return string
	 */
	public function getHeader() {
		return $this->r_headers;
	}
	
	public function getInfo(){
		return curl_getinfo($this->ch);
	}

	public function getStatus(){
		$info = $this->getInfo();
		return $info['http_code'];
	}
}
?>