<?php
//if(!CLI) { exit; }
include_once(APPPATH . 'third_party/simplehtmldom_1_5/simple_html_dom.php');
require_once APPPATH . 'third_party/cURL.php';

class Cron extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->load->config('tick');
		//$this->load->library('Tick');
	}

	public function index($a = 1, $b = 2, $c = 3) {echo ENV; echo $a,$b,$c; echo base_url; }

	public function test(){
		$this->load->library('Coins');
		//$d = $this->coins->get24HourPrices(array('bitcoin', 'ripple'), '2017-12-10'); // date shd not be used in prd

		//$d = $this->coins->getCoinList();
		//$d = $this->coins->getByDays('bitcoin', 1);
		//$d = $this->coins->getTopLoosers();
		//$d = $this->coins->get24hPriceDifference(array('bitcoin', 'ripple'));
		$d = $this->coins->getHistoricByDays('bitcoin');
		print_r($d);
	}

	//// coins/crypto

	public function getCoinMarketCapData(){
		$this->load->model('coins_hourly_model');
		$this->load->model('coins_meta_model');

		$api = 'https://api.coinmarketcap.com/v1/ticker/?start=0&limit=10000';
		$data = fetchJsonFeed($api);

		if($data){
			$c = 0;
			foreach($data as $k => $coin){
				if($this->_isWorthyCoin($coin)){
					$c++;
					$coin_data = $this->coins_hourly_model->prepareData($coin);

					$coin_data->month = date('Y-m', $coin_data->last_updated);
					$coin_data->date = date('Y-m-d', $coin_data->last_updated);
					$coin_data->hour = date('H', $coin_data->last_updated);
					$coin_data->insert_ts = time();

					//$coin_hourly_entry = $this->coins_hourly_model->isExists($coin_data->coin_id, $coin_data->date, $coin_data->hour);
					// to remove hourly restriction
					$coin_hourly_entry = $this->coins_hourly_model->isExists($coin_data->coin_id, $coin_data->date, $coin_data->last_updated);
					if(!$coin_hourly_entry) {
						$this->coins_hourly_model->insert($coin_data);
					} else {
						$this->coins_hourly_model->update(array('id' => $coin_hourly_entry->id), $coin_data);
					}
					$this->_updateCoinMetaInfo($coin_data);
				} else {
					//unset($data[$k]);
				}
			}
			echo $c, ' - ', date('Y-m-d H:i:s'), "\n";
		}

	}

	private function _isWorthyCoin($coin){
		if(!$coin->last_updated) return false;
		//if(!($coin->market_cap_usd || $coin->available_supply || $coin->total_supply)) return false;
		//if($coin->market_cap_usd < 500000) return false; // 5 mil
		//if($coin->{"24h_volume_usd"} < 1000000) return false;
		return true;
	}

	// https://api.bitfinex.com/v1/tickers/
	// https://api.bithumb.com/public/ticker/ALL
	// https://api.hitbtc.com/api/2/public/ticker/

	public function getCoinMarketCapHistoricDailyDataDump(){
		// https://coinmarketcap.com/currencies/counterparty/historical-data/?start=20110101&end=20171208
		//https://graphs.coinmarketcap.com/currencies/ripple/1512770041000/1512856441000/

		$api = 'https://api.coinmarketcap.com/v1/ticker/?start=0&limit=10000';
		$data = fetchJsonFeed($api);
		$start = 0;
		if($data){
			$c = 0;
			foreach($data as $k => $coin){
				echo $c, ' - ', $coin->id , "\n";
				//if($coin->id == 'stealthcoin') $start = 1;
				//if(!$start) continue;
				
				//if($this->_isWorthyCoin($coin)){
					$c++;
					$dates = array(array('20110101', '20120101'), array('20120101', '20130101'), array('20130101', '20140101'),
						array('20140101', '20150101'), array('20150101', '20160101'), array('20160101', '20170101'), 
						array('20170101', '20180101'), array('20180101', date('Ymd')));

					foreach($dates as $k => $dt)
						$this->getCoinMarketCapHistoric($coin->id, $dt[0], $dt[1]);
				//}
			}
		}

	}

	public function getCoinMarketCapHistoricDailyData(){
		$api = 'https://api.coinmarketcap.com/v1/ticker/?start=0&limit=10000';
		$data = fetchJsonFeed($api);
		$start = 0;
		if($data){
			$c = 0;
			foreach($data as $k => $coin){
				echo $c, ' - ', $coin->id , "\n";
				//if($coin->id == 'stealthcoin') $start = 1;
				//if(!$start) continue;
				
				//if($this->_isWorthyCoin($coin)){
					$c++;

					$this->getCoinMarketCapHistoric($coin->id, date('Ymd', strtotime('-3 day')), date('Ymd'));
				//}
			}
		}
	}

	public function getCoinMarketCapHistoric($coin_id = '', $start_date = '' , $end_date = ''){
		if(!$coin_id) return false;
		$this->load->model('coins_meta_model');
		$this->load->model('coins_historic_model');

		echo $url = 'https://coinmarketcap.com/currencies/'.$coin_id .'/historical-data/?start='.$start_date.'&end='.$end_date;
		echo "\n";

		$curl = new Curl(rand()); // id can be session based
		$content = $curl->exec($url); // retry -f status is not 200
		if(!$curl->getStatus() == '200') $content = $curl->exec($url);
		if(!$content) return false; // or continue 

		$html = str_get_html($content);

		$meta_data = array();
		$links = array();
		$objs = $html->find('ul.list-unstyled li a'); // links
		foreach($objs as $k => $el){
			$key = str_replace(' ', '_', strtolower(trim($el->innertext)));
			$links[$key] = $el->href;
		}
		
		$tags = array();
		$objs = $html->find('ul.list-unstyled li small'); // tags
		foreach($objs as $k => $el){ // Mineable , Coin, Token
			$tag = strtolower(trim($el->plaintext));
			if($tag == 'mineable') $tags[] = 'mineable';
			if($tag == 'coin') {
				$tags[] = 'coin';
				$meta_data['type'] = 'coin';
			}
			if($tag == 'token') {
				$tags[] = 'token';
				$meta_data['type'] = 'token';
			}
		}
		
		$meta_data['tags'] = implode(',', $tags);
		$meta_data['links'] = json_encode($links);
		
		$this->coins_meta_model->update(array('coin_id' => $coin_id), $meta_data);

		$data = array();
		$col_map = array('date', 'open', 'high', 'low', 'close', 'volume', 'market_cap');
		$table = $html->find('div table.table tbody', 0);
		
		
		foreach($table->find('tr') as $i => $tr){
			if($i == 0) continue; 
			$row = array('coin_id' => $coin_id);
			$tds = $tr->find('td');
			if(count($tds) != count($col_map)) return false; // cols count not matching ... source structure changed

			foreach($tds as $k => $td){
				$value = trim($td->innertext);
				$row[$col_map[$k]] = $value;
				if($col_map[$k] == 'date'){
					$ts = strtotime($value);
					$row[$col_map[$k]] = date('Y-m-d', $ts);
					$row['year'] = date('Y', $ts);
					$row['month'] = date('Y-m', $ts);
					$row['ts'] = $ts;
				} elseif($col_map[$k] == 'volume' || $col_map[$k] == 'market_cap') {
					$row[$col_map[$k]] = (int) str_replace(',', '', $row[$col_map[$k]]);
					if(!$row[$col_map[$k]]) $row[$col_map[$k]] = null;
				} elseif($col_map[$k] == 'open' || $col_map[$k] == 'high' || $col_map[$k] == 'low' || $col_map[$k] == 'close'){
					$row[$col_map[$k]] = (float) str_replace(',', '', $row[$col_map[$k]]);
					if(!$row[$col_map[$k]]) $row[$col_map[$k]] = null;
				}
			}
			$row['insert_ts'] = time();
			//$data[] = $row; 

			if(!$this->coins_historic_model->isExists($coin_id, $row['date']))
				$this->coins_historic_model->insert($row);
		} 
		echo $i, "\n";

	}

	public function getBitfinexTicker(){
		$this->load->model('coins_bitfinex_model');
		//$this->load->model('coins_meta_model'); // some meta info can be updated

		$api = 'https://api.bitfinex.com/v1/tickers/';
		$data = fetchJsonFeed($api);

		if($data){
			$c = 0;
			foreach($data as $k => $coin){
				$c++;
					$coin_data = $this->coins_bitfinex_model->prepareData($coin);

					$coin_row = $this->coins_bitfinex_model->isExists($coin_data->pair, $coin_data->timestamp);
					if(!$coin_row) {
						$this->coins_bitfinex_model->insert($coin_data);
					} else {
						$this->coins_bitfinex_model->update(array('id' => $coin_row->id), $coin_data);
					}
					//$this->_updateCoinMetaInfo($coin_data);

			}
			echo $c, ' - ', date('Y-m-d H:i:s'), "\n";
		}
	}

	public function getBinanceTicker(){
		$this->load->model('coins_binance_model');
		//$this->load->model('coins_meta_model');

		$api = 'https://api.binance.com/api/v1/ticker/24hr';
		$data = fetchJsonFeed($api);

		if($data){
			$c = 0;
			foreach($data as $k => $coin){
				$c++;
				$coin_data = $this->coins_binance_model->prepareData($coin);

					$coin_row = $this->coins_binance_model->isExists($coin_data->symbol, $coin_data->closeTime);
					if(!$coin_row) {
						$this->coins_binance_model->insert($coin_data);
					} else {
						$this->coins_binance_model->update(array('id' => $coin_row->id), $coin_data);
					}
					//$this->_updateCoinMetaInfo($coin_data);

			}
			echo $c, ' - ', date('Y-m-d H:i:s'), "\n";
		}
	}

	private function _updateCoinMetaInfo($coin_data){
		if(!$coin_data) return false;

		$coin = new coins_meta_model($coin_data->coin_id);


		if(!$coin->loaded()) $coin->insert_ts = time();
		$coin->updated_ts = time();
		$coin->prepareData($coin_data);
		$coin->save();

	}

}
