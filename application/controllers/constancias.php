<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Constancias extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('constancias_model');
  		$this->load->database('default');
	}

	public function index(){
		$this->load->view('admin/header');
		$this->load->view('admin/constancias_view');
		$this->load->view('footer');
	}

}