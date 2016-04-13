<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Correo extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('correo_model');
  		$this->load->database('default');
	}

	public function mail_admin(){
		$data['query'] = $this->correo_model->getCorreos();

		$this->load->view('admin/header');
		$this->load->view('admin/correo_view', $data);
		$this->load->view('footer');
	}

	public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->correo_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th>Remitente</th>";
        echo "<th>Asunto</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td><input type='checkbox'></td>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Asunto."</td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay remitentes registrados con el nombre introducido.</p></div>"; ?></p>
      <?php
      }
    }

}