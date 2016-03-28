<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('actividades_model');
  		$this->load->database('default');
	}

	public function index(){
		$data['query'] = $this->actividades_model->getActividades();

		$this->load->view('admin/header');
		$this->load->view('admin/actividades_view', $data);
		$this->load->view('footer');
	}

}