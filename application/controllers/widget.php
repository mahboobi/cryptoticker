 <?php

class Widget extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->viewData['module'] = 'widget'; // not required in direct wo
		//$this->load->model('users_model');
		//$this->auth->check();
    $this->load->library('Coins');
	}

	function index(){
		$viewData['coin_list'] = $this->coins->getCoinList();

    $coin_ids = array() ;
    foreach($viewData['coin_list'] as $coin){
      $coin_ids[] = $coin->coin_id;
    };

    $viewData['coin_prices'] = $this->coins->get24HourPrices($coin_ids, '2017-12-10'); // chk ..c hk kar
//pr($viewData['coin_prices']); die();
    $this->load->view('widget/index', $viewData); // this is direct way
	}

  function heatmap(){

    $viewData['coin_list'] = $this->coins->getCoinList();


    $this->load->view('widget/heatmap', $viewData); // this is direct way
  }

  function gainerslosers(){

    $viewData['coin_gainers'] = $this->coins->getTopGainers();
    //pr($viewData['coin_gainers']);
    $coin_ids = array() ;
    foreach($viewData['coin_gainers'] as $coin){
      $coin_ids[] = $coin->coin_id;
    }
    //pr($coin_ids); // other data not there ...
    $viewData['coin_prices'] = $this->coins->get24HourPrices($coin_ids, '2017-12-17'); // chk ..c hk kar
    //pr($viewData['coin_prices']); die();

    $viewData['coin_loosers'] = $this->coins->getTopLoosers();
    $coin_ids = array() ;
    foreach($viewData['coin_loosers'] as $coin){
      $coin_ids[] = $coin->coin_id;
    };


    $this->load->view('widget/gainerslosers', $viewData); // this is direct way
  }


  function recommendation(){

    $viewData['coin_list'] = $this->coins->getCoinList();
    $coin_ids = array() ;
    foreach($viewData['coin_list'] as $coin){
      $coin_ids[] = $coin->coin_id;
    };
    $this->load->view('widget/recommendation', $viewData); // this is direct way
  }

  function fibonacci(){

    $this->load->view('widget/fibonacci'); // this is direct way
  }
  function pivotpoint(){

    $this->load->view('widget/pivotpoint'); // this is direct way
  }


}
