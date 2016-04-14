<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('actividades_model');
  		$this->load->database('default');
	}

	public function act_admin(){
		$data['query'] = $this->actividades_model->getActividades();

		$this->load->view('admin/header');
		$this->load->view('admin/actividades_view', $data);
		$this->load->view('footer');
	}


  public function act_doc(){
    $data['query'] = $this->actividades_model->getActividades();

    $this->load->view('docente/header');
    $this->load->view('docente/actividades_view_doc', $data);
    $this->load->view('footer');
  }

	public function act_direc(){
		$data['query'] = $this->actividades_model->getActividades();

		$this->load->view('director/header');
		$this->load->view('director/actividades_view', $data);
		$this->load->view('footer');
	}

	public function agregarActividad(){
		$nombre = $this->input->post('nombre');
		$tipo = $this->input->post('tipo');
		$lugar = $this->input->post('lugar');
		$fechaini = $this->input->post('fechaini');
		$fechafin = $this->input->post('fechafin');
		$this->load->model('actividades_model');
		$insert = $this->actividades_model->agregarActividad($nombre, $tipo, $lugar, $fechaini, $fechafin);	
	}

	public function modificar(){
		$id = $this->uri->segment(3);
		$this->load->model('actividades_model');
		$data['query'] = $this->actividades_model->getActividadesID($id);

    $this->load->view('admin/header');
		$this->load->view('admin/actividades_edit_view', $data);
    $this->load->view('footer');
	}

  public function updateActividad(){
    $id = $this->input->post('id');
    $nombre = $this->input->post('nombre');
    $tipo = $this->input->post('tipo');
    $lugar = $this->input->post('lugar');
    $fechaini = $this->input->post('fechaini');
    $fechafin = $this->input->post('fechafin');
    $this->load->model('actividades_model');
    $insert = $this->actividades_model->updateAct($id, $nombre, $tipo, $lugar, $fechaini, $fechafin);  
  }

  public function delete(){
    $id = $this->uri->segment(3);
    $this->load->model('actividades_model');
    $delete = $this->actividades_model->deleteAct($id);
  }

	public function autocompletarB(){
    $this->load->database('default');
    $this->load->model('actividades_model');
      $data = array();
    //si es una petición ajax y existe una variable post
    //llamada info dejamos pasar
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->actividades_model->buscador(trim($abuscar));
      //si search es distinto de false significa que hay resultados
      //y los mostramos con un loop foreach
      if($search !== FALSE){
      	echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Tipo</th>";
        echo "<th>Lugar</th>";
        echo "<th>Fecha inicio</th>";
        echo "<th>Fecha fin</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
          	echo "<tr>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Lugar."</td>";
            echo "<td>".$fila->Fecha_Inicio."</td>";
            echo "<td>".$fila->Fecha_Fin."</td>";
            echo "<td><a href='".base_url()."actividades/modificar/$fila->ID_Actividad'> <i class='glyphicon glyphicon-pencil'></i></a></td>";
            echo "<td><a href='".base_url()."actividades/delete/$fila->ID_Actividad'> <i class='glyphicon glyphicon-trash'></i></a></td>";
            echo "</tr>";
        ?>
        <?php
        /*
        foreach ($empleados->result() as $row){

        } 
        */
        }
      //en otro caso decimos que no hay resultados
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay actividades registradas con el nombre, tipo o lugar introducido.</p></div>"; ?></p>
      <?php
      }
    }

  }

    public function autocompletar(){
    $this->load->database('default');
    $this->load->model('actividades_model');
      $data = array();
    //si es una petición ajax y existe una variable post
    //llamada info dejamos pasar
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->actividades_model->buscador(trim($abuscar));
      //si search es distinto de false significa que hay resultados
      //y los mostramos con un loop foreach
      if($search !== FALSE){
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Tipo</th>";
        echo "<th>Lugar</th>";
        echo "<th>Fecha inicio</th>";
        echo "<th>Fecha fin</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Lugar."</td>";
            echo "<td>".$fila->Fecha_Inicio."</td>";
            echo "<td>".$fila->Fecha_Fin."</td>";
            echo "</tr>";
        ?>
        <?php
        /*
        foreach ($empleados->result() as $row){

        } 
        */
        }
      //en otro caso decimos que no hay resultados
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay actividades registradas con el nombre, tipo o lugar introducido.</p></div>"; ?></p>
      <?php
      }
    }

  }

}