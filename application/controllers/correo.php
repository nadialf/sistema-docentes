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
		$this->load->view('docente/header');
		$this->load->view('docente/correo_doc_view');
		$this->load->view('footer');
	}
	public function agregarCorreo(){
		$usuario = $this->input->post('de',true);
		$datos=$this->login_model->cuenta($usuario);
		foreach ($datos->result() as $row) {
			$id=$row->ID_Trabajador;
		}
		$data['id'] =$id;

		$datos = array (
			'ID_Remitente' =>($id),
			'Destinatario' => $this->input->post('para',true),
			'Asunto' => $this->input->post('asunto',true),
			'Leido' => ('1')
			);
		$this->docentes_model->guarda_correo($datos);
			
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
        echo "<th>Asunto</th>";
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

}