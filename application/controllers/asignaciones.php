<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Asignaciones extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('asignaciones_model');
  		$this->load->database('default');
	}

	public function index(){
		$data['query'] = $this->asignaciones_model->getAsignaciones();

		$this->load->view('admin/header');
		$this->load->view('admin/asignaciones_view', $data);
		$this->load->view('footer');
	}

	public function showDocentes(){
        $q = strtolower($_GET['term']);
        $this->load->database('default');
        $this->load->model('asignaciones_model');
        $valores = $this->asignaciones_model->verDocentes($q);
        echo json_encode($valores);  
  }

}