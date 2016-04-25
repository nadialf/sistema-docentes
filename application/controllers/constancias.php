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

  public function newConstancia(){
    $id = $this->uri->segment(3);
    $data = array(
      'userfile' => $this->input->post('userfile', TRUE)
    );
    
    $this->constancias_model->upload_constancia($id, $data);
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
        echo "<th>Formato sin firma</th>";
        echo "<th>Formato con firma</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>
                    <a href='".base_url()."constancias/formatoDownload/$fila->ID_Solicitud');> <i class='glyphicon glyphicon-save' title='Descargar formato sin firma'></i></a>
                  </td>";
            echo "<td>";
                    $this->load->database('default');
                    $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                    $this->db->from('constancias');
                    $this->db->where('ID_Solicitud', $fila->ID_Solicitud);
                    $query = $this->db->get();

                    if($query->num_rows() > 0){
                      foreach ($query->result() as $row) {
                        if ($row->Formato != '') {
                          $ruta = base_url().$row->Formato;
                          $Archivo = "<a href='$ruta' target='_blank' title='Constancia'> <i class='glyphicon glyphicon-file' title='Ver formato con firma'></i></a>";
                        echo $Archivo;
                        }
                      }
                    }
            echo "</td>";
            echo "<td>";
                    $action = base_url()."constancias/newConstancia/".$fila->ID_Solicitud;
                    $form = "<form method='post' accept-charset='utf-8' action='$action' enctype='multipart/form-data'>
                              <input type='file' accept='image/*'' name='userfile' /> </br>
                              <input type='submit' value='Guardar' />
                              </form>";
                    echo $form;
            echo  "</td>";
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

    public function formatoDownload(){
      $id = $this->uri->segment(3);

      require_once '/PHPWord-master/src/PhpWord/Autoloader.php';
      \PhpOffice\PhpWord\Autoloader::register();

      require_once '/PHPWord-master/src/PhpWord/TemplateProcessor.php';

      $templateWord = new PhpOffice\PhpWord\TemplateProcessor('C:\xampp\htdocs\sistema-docentes\application\controllers\plantilla-constancia.docx');
 
      $data = $this->constancias_model->getSolicitudID($id);
      foreach($data->result() as $fila){
          $docente = $fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno;
          $tipo = $fila->Tipo;
          $actividad = $fila->Nombre;
          $fechaini = $fila->Fecha_Inicio;
          $fechafin = $fila->Fecha_Fin;

          // --- Asignamos valores a la plantilla
          $templateWord->setValue('nombre_docente',$docente);
          $templateWord->setValue('nombre_tipo',$tipo);
          $templateWord->setValue('nombre_actividad',$actividad);
          $templateWord->setValue('fecha_inicio',$fechaini);
          $templateWord->setValue('fecha_fin',$fechafin);

          // --- Guardamos el documento
          $templateWord->saveAs('Constancia_'.$fila->Nombres.'.docx');

          header("Content-Disposition: attachment; filename=Constancia_$fila->Nombres.docx; charset=iso-8859-1");
          echo file_get_contents('Constancia_'.$fila->Nombres.'.docx');
      }
    }

    public function delete(){
    $id = $this->uri->segment(3);
    $delete = $this->constancias_model->deleteSolicitud($id);
  }

}