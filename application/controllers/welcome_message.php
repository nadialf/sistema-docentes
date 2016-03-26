<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_message extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('login_model');
  		$this->load->database('default');
  		//$this->load->model('citas_model');
	}

	public function index(){
		$this->load->view('message_view');
	}

	

}
