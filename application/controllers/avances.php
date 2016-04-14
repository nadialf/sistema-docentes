<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Avances extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('avances_model');
  		$this->load->database('default');
	}

	public function index(){
		$data['query'] = $this->avances_model->getAvances();

		$this->load->view('admin/header');
		$this->load->view('admin/avances_view', $data);
		$this->load->view('footer');
	}

	public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->avances_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Fecha de inicio</th>";
        echo "<th>Progreso</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>".$fila->Fecha_Inicio."</td>";
            echo "<td></td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay avances de asignación registrados con el nombre, tipo o lugar introducido.</p></div>"; ?></p>
      <?php
      }
    }

}