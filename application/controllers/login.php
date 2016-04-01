<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('login_model');
  		$this->load->database('default');
	}

	public function index() {
		$this->load->database('default');
		$this->load->view('login_view');
		$this->load->view('footer');
	}

	public function new_login() {
		$usuario = $this->input->post('usuario');
		$contrasena = $this->input->post('contrasena');
		$insert = $this->login_model->validate($usuario, $contrasena);

	}

	public function logout() {
		redirect(base_url());
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */