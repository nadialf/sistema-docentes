<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_message extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('login_model');
  		$this->load->database('default');
  		//$this->load->model('citas_model');
	}

	public function admin(){
		$this->load->view('admin/header');
		$this->load->view('message_view');
		$this->load->view('footer');
	}

	public function director(){
		$this->load->view('director/header');
		$this->load->view('message_view');
		$this->load->view('footer');
	}

	public function docente($idCuenta){
		//$this->load->view('docente/header');
		//$this->load->view('footer');
		echo$idCuenta;
	}

}
