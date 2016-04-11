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

	public function newAsignacion(){
		$docente = $this->input->post('docente');
		$tipo = $this->input->post('tipo');
		$actividad = $this->input->post('actividad');
		$fecha = $this->input->post('fecha');
		$insert = $this->asignaciones_model->saveAsignacion($docente, $tipo, $actividad, $fecha);
		
		redirect(base_url().'asignaciones');
	}

	public function showDocentes(){
		$q = strtolower($_GET['term']);
		$valores = $this->asignaciones_model->getDocentes($q);
		echo json_encode($valores);  
	}

	public function showActividades(){
    	$q = strtolower($_GET['term']);
    	$tipo = $_GET['tipo'];
    	/*print_r($rama);*/
    	$valores = $this->asignaciones_model->getActividades($q, $tipo);
    	echo json_encode($valores);  
  }

}