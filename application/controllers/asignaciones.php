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

  public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->asignaciones_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Fecha de incorporación</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>".$fila->Fecha_Incorporacion."</td>";
            echo "<td><a href='".base_url()."asignaciones/modificar/$fila->ID_Actividad'> <i class='glyphicon glyphicon-pencil' title='Editar'></i></a></td>";
            echo "<td><a href='".base_url()."asignaciones/delete/$fila->ID_Actividad'> <i class='glyphicon glyphicon-trash' title='Eliminar'></i></a></td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay actividades registradas con el nombre, tipo o lugar introducido.</p></div>"; ?></p>
      <?php
      }
    }

    public function modificar(){
    $id = $this->uri->segment(3);
    $data['query'] = $this->asignaciones_model->getAsignacionesID($id);

    $this->load->view('admin/header');
    $this->load->view('admin/asignaciones_edit_view', $data);
    $this->load->view('footer');
  }

  public function updateAsignacion(){
    $id = $this->input->post('id');
    $nombre = $this->input->post('docente');
    $tipo = $this->input->post('tipo');
    $lugar = $this->input->post('actividad');
    $fechaini = $this->input->post('fecha');
    $insert = $this->asignaciones_model->updateAsig($id, $nombre, $tipo, $lugar, $fechaini, $fechafin);  
  }

  public function delete(){
    $id = $this->uri->segment(3);
    $this->load->model('actividades_model');
    $delete = $this->actividades_model->deleteAct($id);
  }

}