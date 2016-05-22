<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Correo extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper(array('url', 'form'));       
  		$this->load->model('correo_model');
  		$this->load->model('login_model');
  		$this->load->model('docentes_model');
  		$this->load->database('default');
	}

	public function mail_admin(){
		$data['query1'] = $this->correo_model->getCorreosNoLeidos();
    $data['query2'] = $this->correo_model->getCorreosLeidos();

		$this->load->view('admin/header');
		$this->load->view('admin/correo_view', $data);
		$this->load->view('footer');
	}
	public function correo_doc(){
    $id = $this->uri->segment(3);
    $data['query'] = $this->docentes_model->getDocenteID($id);
    $data['query1'] = $this->correo_model->getMisCorreos($id);

		$this->load->view('docente/header', $data);
		$this->load->view('docente/correo_doc_view', $data);
		$this->load->view('footer');
	}
	public function newMail(){
    $remitente = $this->uri->segment(3);
    $fecha = $this->input->post('fecha');
    $mensaje = $this->input->post('mensaje');
    $insert = $this->correo_model->agregarMail($remitente, $fecha, $mensaje);
	}

  public function changeNoLeido(){
    $id = $this->uri->segment(3);
    $changeNoLeido = $this->correo_model->changeMail1($id);
  }

  public function changeLeido(){
    $id = $this->uri->segment(3);
    $changeLeido = $this->correo_model->changeMail2($id);
  }

	 public function delete(){
    	$id = $this->uri->segment(3);
    	$delete = $this->correo_model->deleteMail($id);
 	}

	public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->correo_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Remitente</th>";
        echo "<th>Mensaje</th>";
        echo "<th>Fecha</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Asunto."</td>";
            echo "<td>".$fila->Fecha_Envio."</td>";
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

    public function autocompletarB(){
    $id = $this->uri->segment(3);
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $id = $this->uri->segment(3);
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->correo_model->buscador2(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Destinatario</th>";
        echo "<th>Mensaje</th>";
        echo "<th>Fecha</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
          if ($fila->ID_Remitente == $id){
            echo "<tr>";
            echo "<td>Administrador</td>";
            echo "<td>".$fila->Asunto."</td>";
            echo "<td>".$fila->Fecha_Envio."</td>";
            echo "</tr>";
          }
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay mensajes registrados con las palabras introducidas.</p></div>"; ?></p>
      <?php
      }
    }

}