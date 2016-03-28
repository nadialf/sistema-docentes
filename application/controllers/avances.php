<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Avances extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('avances_model');
  		$this->load->database('default');
	}

	public function index(){
		$this->load->view('admin/header');
		$this->load->view('admin/avances_view');
		$this->load->view('footer');
	}

}