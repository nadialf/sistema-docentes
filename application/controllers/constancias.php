<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Constancias extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
      $this->load->helper(array('url', 'form'));       
  		$this->load->model('constancias_model');
      $this->load->model('docentes_model');
      $this->load->model('actividades_model');
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
    $id = $this->uri->segment(3);
    $data1['query'] = $this->docentes_model->getDocenteID($id);
    $data['query'] = $this->constancias_model->getSolicitudesAceptadas();

    $this->load->view('director/header', $data1);
    $this->load->view('director/constancias_view', $data);
    $this->load->view('footer');
  }

  public function mis_cons_direc(){
    $id = $this->uri->segment(3);
    $data1['query'] = $this->docentes_model->getDocenteID($id);
    $data['query1'] = $this->actividades_model->getMisAvances($id);

    $this->load->view('director/header', $data1);
    $this->load->view('director/misconstancias_view', $data);
    $this->load->view('footer');
  }

  public function cons_docente(){
    $id = $this->uri->segment(3);
    $data['query'] = $this->docentes_model->getDocenteID($id);
    $data1['query'] = $this->actividades_model->getMisAvances($id);

    $this->load->view('docente/header', $data);
    $this->load->view('docente/constancias_view_doc', $data1);
    $this->load->view('footer');
  }

  public function newConstancia(){
    $docente = $this->uri->segment(3);
    $id = $this->uri->segment(4);
    $this->constancias_model->upload_constancia($id, $docente);
  }

  public function newSolicitud(){
    $docente = $this->uri->segment(3);
    $actividad = $this->uri->segment(4);
    $this->constancias_model->upload_solicitud($docente, $actividad);
  }

  public function newSolicitudD(){
    $docente = $this->uri->segment(3);
    $actividad = $this->uri->segment(4);
    $this->constancias_model->upload_solicitudD($docente, $actividad);
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
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
            echo "<tr>";
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

    public function autocompletarC(){ //Docente
    $docente = $this->uri->segment(3);
    $data = array();
    if($this->input->is_ajax_request() && $this->input->post('info')){
      $abuscar = $this->security->xss_clean($this->input->post('info'));
      $search = $this->constancias_model->buscadorDocente(trim($abuscar));
        echo "<thead>";
        echo "<tr>";
        echo "<th>Actividad</th>";
        echo "<th>Tipo</th>";
        echo "<th>Progreso</th>";
        echo "<th>Formato</th>";
        echo "<th>Estado</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($search->result() as $fila){
          if ($fila->ID_Trabajador == $docente) {
            echo "<tr>";
                echo "<td>".$fila->Nombre."</td>";
                echo "<td>".$fila->Tipo."</td>";
                echo "<td>".$fila->Avance."</td>";

                $this->db->distinct();
                $this->db->select('asignaciones.ID_Asignacion, asignaciones.Avance, asignaciones.ID_Trabajador, asignaciones.ID_Actividad, 
                  solicitudes.ID_Solicitud, solicitudes.Etapa, solicitudes.ID_Trabajador, solicitudes.ID_Actividad, solicitudes.Aceptada');
                $this->db->from('asignaciones');
                $this->db->where('asignaciones.ID_Trabajador', $fila->ID_Trabajador);
                $this->db->where('asignaciones.ID_Asignacion', $fila->ID_Asignacion);
                $this->db->where('asignaciones.ID_Actividad', $fila->ID_Actividad);
                $this->db->join('solicitudes', 'solicitudes.ID_Actividad = asignaciones.ID_Actividad');
                $this->db->where('solicitudes.ID_Trabajador', $fila->ID_Trabajador);
                $this->db->group_by('asignaciones.ID_Asignacion');
                $query = $this->db->get();

                if($query->num_rows() > 0){
                  foreach ($query->result() as $line) {
                    
                    if ($line->Etapa == 'Firmada'){
                       
                       $ruta = base_url().'constancias/formatoFirmaDownload3/'.$line->ID_Solicitud;
                       $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>"; ?>
                        
                        <td><?php echo $Archivo; ?></td>
                        <td><?php echo "<span style='color: #FF0000'>$line->Etapa</span>"; ?></td> <?php

                    } elseif ($line->Etapa == 'En proceso'){ ?>
                        <td></td>
                        <td><?php echo "<span style='color: #0000FF'>$line->Etapa</span>"; ?></td> <?php
                    } elseif ($line->Etapa == 'Aceptada'){ ?>
                        <td></td>
                        <td><?php echo "<span style='color: #31B404'>$line->Etapa</span>"; ?></td> <?php
                    }
                  }
                } else { ?>
                    <td></td>
                    <td>
                      <?php
                      if ($fila->Avance == 'Terminada') { ?>
                        <?=  form_open(base_url().'constancias/newSolicitud/'.$fila->ID_Trabajador.'/'.$fila->ID_Actividad)?>
                          <input type="submit"  value="Solicitar" class="btn btn-primary">
                        <?=form_close()?> <?php
                      } else { ?>
                          <?=  form_open()?>
                            <input type="submit" value="Solicitar" class="btn btn-primary disabled">
                          <?=form_close()?> <?php
                      } ?>
                    </td> <?php
                }

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

    public function formatoFirmaDownload3(){
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

          redirect(base_url().'constancias/cons_docente/'.$fila->ID_Trabajador);
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