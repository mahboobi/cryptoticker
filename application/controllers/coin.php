 <?php

class Coin extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->viewData['module'] = 'widget'; // not required in direct wo
		//$this->load->model('users_model');
		//$this->auth->check();
    $this->load->library('Coins');
  }

	function index($coin_id = 'bitcoin'){
		//redirect('/exchange');
		//$this->viewData['page'] = 'whatever';  // not required in direct wo

		//$this->utils->loadViewController();  /// this is to reduce lot of repetitive stuffs in view modules eg: header/footer/ common parts...

    $viewData['coin_meta'] = $this->coins->getCoinById($coin_id );

 		$viewData['coin_data'] = $this->coins->get24HourPrices($coin_id, '2017-12-10'); // date is optional

    $this->load->view('widget/bitcoin', $viewData); // this is direct way
	}
} // where is what
