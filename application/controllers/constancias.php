<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Constancias extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
      $this->load->helper(array('url', 'form'));       
  		$this->load->model('constancias_model');
  		$this->load->database('default');
    }

	public function cons_admin(){
		$data['query1'] = $this->constancias_model->getSolicitudesNoAceptadas();
    $data['query2'] = $this->constancias_model->getSolicitudesAceptadas();

		$this->load->view('admin/header');
		$this->load->view('admin/constancias_view', $data);
		$this->load->view('footer');
	}

  public function cons_direc(){
    $data['query'] = $this->constancias_model->getSolicitudesAceptadas();

    $this->load->view('director/header');
    $this->load->view('director/constancias_view', $data);
    $this->load->view('footer');
  }

  public function newConstancia(){
    $id = $this->uri->segment(3);    
    $this->constancias_model->upload_constancia($id);
  }

	public function autocompletar(){
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->constancias_model->buscador(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Aceptar</th>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Formato sin firma</th>";
        echo "<th>Formato con firma</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
            echo "<td></td>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>
                    <a href='".base_url()."constancias/formatoDownload/$fila->ID_Solicitud'); class='btn-lg'> <i class='glyphicon glyphicon-save' title='Descargar formato sin firma'></i></a>
                  </td>";
            echo "<td>";
                    $this->load->database('default');
                    $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                    $this->db->from('constancias');
                    $this->db->where('ID_Solicitud', $fila->ID_Solicitud);
                    $query = $this->db->get();

                    if($query->num_rows() > 0){
                      foreach ($query->result() as $row) {
                          $ruta = base_url().'constancias/formatoFirmaDownload2/'.$row->ID_Solicitud;
                          $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>";
                        echo $Archivo;
                      }
                    }
            echo "</td>";
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

    public function autocompletarB(){ //Director
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->constancias_model->buscadorDirector(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Docente</th>";
        echo "<th>Tipo</th>";
        echo "<th>Actividad</th>";
        echo "<th>Formato con firma</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
          if ($fila->Aceptada == '1'){
            echo "<tr>";
            echo "<td>".$fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno."</td>";
            echo "<td>".$fila->Tipo."</td>";
            echo "<td>".$fila->Nombre."</td>";
            echo "<td>";
                    $this->load->database('default');
                    $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                    $this->db->from('constancias');
                    $this->db->where('ID_Solicitud', $fila->ID_Solicitud);
                    $query = $this->db->get();

                    if($query->num_rows() > 0){
                      foreach ($query->result() as $row) {
                          $ruta = base_url().'constancias/formatoFirmaDownload/'.$row->ID_Solicitud;
                          $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>";
                        echo $Archivo;
                      }
                    }
            echo "</td>";
            echo "<td>";
              if ($fila->Etapa == "Aceptada"){
                echo form_open(base_url().'constancias/newConstancia/'.$fila->ID_Solicitud);
                  echo "<input type='submit' value='Firmar' class='btn btn-primary'>";
                echo form_close();
              }
            echo "</td>";
            echo "</tr>";
          }
        }
      } else{
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

          $word = new COM("Word.Application") or die ("Could not initialise Object.");
          // set it to 1 to see the MS Word window (the actual opening of the document)
          $word->Visible = 0;
          // recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
          $word->DisplayAlerts = 0;
          // open the word 2007-2013 document 
          $word->Documents->Open('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.docx');
          // save it as word 2003
          $word->ActiveDocument->SaveAs('C:\xampp\htdocs\sistema-docentes\newdocument.doc');
          // convert word 2007-2013 to PDF
          $word->ActiveDocument->ExportAsFixedFormat('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
          // quit the Word process
          $word->Quit(false);
          // clean up
          $word = null;

          $ruta = 'Constancia_'.$fila->Nombres.'.pdf';
          header('Content-Type: application/force-download');
          header('Content-Disposition: attachment; filename='.$ruta);
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: '.filesize($ruta));
          readfile($ruta);

          unlink($ruta);
          unlink('Constancia_'.$fila->Nombres.'.docx');
          unlink('newdocument.doc');

          redirect(base_url().'constancias/cons_admin');
      }
    }

    public function formatoFirmaDownload(){
      $id = $this->uri->segment(3);

      require_once '/PHPWord-master/src/PhpWord/Autoloader.php';
      \PhpOffice\PhpWord\Autoloader::register();
      require_once '/PHPWord-master/src/PhpWord/TemplateProcessor.php';
      $templateWord = new PhpOffice\PhpWord\TemplateProcessor('C:\xampp\htdocs\sistema-docentes\application\controllers\plantilla-constancia-firma.docx');
 
      $data = $this->constancias_model->getSolicitudID($id);
      foreach($data->result() as $fila){
          $docente = $fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno;
          $tipo = $fila->Tipo;
          $actividad = $fila->Nombre;
          $fechaini = $fila->Fecha_Inicio;
          $fechafin = $fila->Fecha_Fin;

          $templateWord->setValue('nombre_docente',$docente);
          $templateWord->setValue('nombre_tipo',$tipo);
          $templateWord->setValue('nombre_actividad',$actividad);
          $templateWord->setValue('fecha_inicio',$fechaini);
          $templateWord->setValue('fecha_fin',$fechafin);

          $templateWord->saveAs('Constancia_'.$fila->Nombres.'.docx');

          $word = new COM("Word.Application") or die ("Could not initialise Object.");
          $word->Visible = 0;
          $word->DisplayAlerts = 0;
          $word->Documents->Open('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.docx');
          $word->ActiveDocument->SaveAs('C:\xampp\htdocs\sistema-docentes\newdocument.doc');
          $word->ActiveDocument->ExportAsFixedFormat('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
          $word->Quit(false);
          $word = null;

          $ruta = 'Constancia_'.$fila->Nombres.'.pdf';
          header('Content-Type: application/force-download');
          header('Content-Disposition: attachment; filename='.$ruta);
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: '.filesize($ruta));
          readfile($ruta);

          unlink($ruta);
          unlink('Constancia_'.$fila->Nombres.'.docx');
          unlink('newdocument.doc');

          redirect(base_url().'constancias/cons_direc');
      }
    }

    public function formatoFirmaDownload2(){
      $id = $this->uri->segment(3);

      require_once '/PHPWord-master/src/PhpWord/Autoloader.php';
      \PhpOffice\PhpWord\Autoloader::register();
      require_once '/PHPWord-master/src/PhpWord/TemplateProcessor.php';
      $templateWord = new PhpOffice\PhpWord\TemplateProcessor('C:\xampp\htdocs\sistema-docentes\application\controllers\plantilla-constancia-firma.docx');
 
      $data = $this->constancias_model->getSolicitudID($id);
      foreach($data->result() as $fila){
          $docente = $fila->Nombres.' '.$fila->ApPaterno.' '.$fila->ApMaterno;
          $tipo = $fila->Tipo;
          $actividad = $fila->Nombre;
          $fechaini = $fila->Fecha_Inicio;
          $fechafin = $fila->Fecha_Fin;

          $templateWord->setValue('nombre_docente',$docente);
          $templateWord->setValue('nombre_tipo',$tipo);
          $templateWord->setValue('nombre_actividad',$actividad);
          $templateWord->setValue('fecha_inicio',$fechaini);
          $templateWord->setValue('fecha_fin',$fechafin);

          $templateWord->saveAs('Constancia_'.$fila->Nombres.'.docx');

          $word = new COM("Word.Application") or die ("Could not initialise Object.");
          $word->Visible = 0;
          $word->DisplayAlerts = 0;
          $word->Documents->Open('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.docx');
          $word->ActiveDocument->SaveAs('C:\xampp\htdocs\sistema-docentes\newdocument.doc');
          $word->ActiveDocument->ExportAsFixedFormat('C:\xampp\htdocs\sistema-docentes\Constancia_'.$fila->Nombres.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
          $word->Quit(false);
          $word = null;

          $ruta = 'Constancia_'.$fila->Nombres.'.pdf';
          header('Content-Type: application/force-download');
          header('Content-Disposition: attachment; filename='.$ruta);
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: '.filesize($ruta));
          readfile($ruta);

          unlink($ruta);
          unlink('Constancia_'.$fila->Nombres.'.docx');
          unlink('newdocument.doc');

          redirect(base_url().'constancias/cons_admin');
      }
    }

    public function delete(){
    $id = $this->uri->segment(3);
    $delete = $this->constancias_model->deleteSolicitud($id);
  }

  public function changeNoAceptada(){
    $id = $this->uri->segment(3);
    $changeNoAceptada = $this->constancias_model->changeSolicitud1($id);
  }

  public function changeAceptada(){
    $id = $this->uri->segment(3);
    $changeAceptada = $this->constancias_model->changeSolicitud2($id);
  }

}