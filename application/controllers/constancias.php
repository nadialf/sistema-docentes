<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Constancias extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('constancias_model');
  		$this->load->database('default');
	}

	public function cons_admin(){
		$data['query'] = $this->constancias_model->getSolicitudes();

		$this->load->view('admin/header');
		$this->load->view('admin/constancias_view', $data);
		$this->load->view('footer');
	}

  public function cons_direc(){
    $data['query'] = $this->constancias_model->getSolicitudes();

    $this->load->view('director/header');
    $this->load->view('director/constancias_view', $data);
    $this->load->view('footer');
  }

	public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->constancias_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Formato</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td></td>";
            echo "<td><a href='".base_url()."constancias/formato/$fila->ID_Solicitud'> <i class='glyphicon glyphicon-paperclip' title='Adjuntar formato'></i></a></td>";
            echo "<td><a href='".base_url()."constancias/delete/$fila->ID_Solicitud'> <i class='glyphicon glyphicon-trash' title='Eliminar'></i></a></td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay solicitudes registradas con el nombre, tipo o actividad introducido.</p></div>"; ?></p>
      <?php
      }
    }

    public function autocompletarB(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->constancias_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Formato</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td></td>";
            echo "<td><a href='".base_url()."constancias/formato/$fila->ID_Solicitud'> <i class='glyphicon glyphicon-paperclip' title='Adjuntar formato'></i></a></td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay solicitudes registradas con el nombre, tipo o actividad introducido.</p></div>"; ?></p>
      <?php
      }
    }

}