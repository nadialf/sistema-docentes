<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_message extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('login_model');
  		$this->load->database('default');
  		$this->load->model('docentes_model');
	}

	public function admin(){
		$this->load->view('admin/header');
		$this->load->view('message_view');
		$this->load->view('footer');
	}

	public function director(){
		$id = $this->uri->segment(3);
		$data['query'] = $this->docentes_model->getDocenteID($id);

		$this->load->view('director/header',$data);
		$this->load->view('message_view1');
		$this->load->view('footer');
	}

	public function docente(){
		$id = $this->uri->segment(3);
		$data['query'] = $this->docentes_model->getDocenteID($id);

		$this->load->view('docente/header',$data);
		$this->load->view('message_view2',$data);
		$this->load->view('footer');
	}

}
