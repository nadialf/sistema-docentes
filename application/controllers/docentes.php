<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('docentes_model');
  		$this->load->database('default');
	}

	public function doc_admin(){
		$data['query'] = $this->docentes_model->getDocentes();

		$this->load->view('admin/header');
		$this->load->view('admin/docentes_view', $data);
		$this->load->view('footer');
	}

	public function agregarDocente(){
		$nombre = $this->input->post('nombre');
		$paterno = $this->input->post('paterno');
		$materno = $this->input->post('materno');
		$tipot = $this->input->post('tipot');
		$user = $this->input->post('user');
		$contrasena = $this->input->post('contrasena');
		$this->load->model('actividades_model');
		$insert = $this->docentes_model->agregarDocente($nombre, $paterno, $materno, $tipot, $user, $contrasena);	
	}

	public function modificar(){
		$id = $this->uri->segment(3);
		$data['query'] = $this->docentes_model->getDocentesID($id);

    	$this->load->view('admin/header');
		$this->load->view('admin/docentes_edit_view', $data);
    	$this->load->view('footer');
	}

	public function updateDocente(){
    $id = $this->input->post('id');
    $nombre = $this->input->post('nombre');
    $paterno = $this->input->post('paterno');
    $materno = $this->input->post('materno');
    $tipot = $this->input->post('tipot');
    $user = $this->input->post('user');
    $contrasena = $this->input->post('contrasena');
    $insert = $this->docentes_model->updateDoc($id, $nombre, $paterno, $materno, $tipot, $user, $contrasena);
    }

    public function delete(){
    $id = $this->uri->segment(3);
    $delete = $this->docentes_model->deleteDoc($id);
  	}


  	public function autocompletar(){
    $this->load->database('default');
    $data = array();

    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->docentes_model->buscador(trim($abuscar));

      if($search !== FALSE){
      	echo "<thead>";
        echo "<tr>";
        echo "<th>No. Control</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido paterno</th>";
        echo "<th>Apellido materno</th>";
        echo "<th>Tipo de trabajador</th>";
        echo "<th>Usuario</th>";
        echo "<th>Contraseña</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
          	echo "<tr>";
            echo "<td>".$fila->ID_Trabajador."<td>";
            echo "<td>".$fila->Nombres."</td>";
            echo "<td>".$fila->ApPaterno."</td>";
            echo "<td>".$fila->ApMaterno."</td>";
            echo "<td>".$fila->TipoTrabajo."</td>";
            echo "<td>".$fila->Usuario."</td>";
            echo "<td>".$fila->Contrasena."</td>";
            echo "<td><a href='".base_url()."docentes/modificar/$fila->ID_Trabajador'> <i class='glyphicon glyphicon-pencil'></i></a></td>";
            echo "<td><a href='".base_url()."docentes/delete/$fila->ID_Trabajador'> <i class='glyphicon glyphicon-trash'></i></a></td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay docentes registrados con el nombre, apellido o usuario introducido.</p></div>"; ?></p>
      <?php
      }
    }

  }

}