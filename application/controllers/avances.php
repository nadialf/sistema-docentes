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
            echo "<td>";
                        if ($fila->Avance == "Por comenzar"){
                            echo "<span style='color: #0000FF'>$fila->Avance</span>";
                        } elseif ($fila->Avance == "En curso"){
                            echo "<span style='color: #31B404'>$fila->Avance</span>";
                        } elseif ($fila->Avance == "Terminada"){
                            echo "<span style='color: #FF0000'>$fila->Avance</span>";
                        }

                "</td>";
            echo "</tr>";
        ?>
        <?php
        }
      }else{
      ?>
        <p><?php  echo "<div class='alert alert-warning'><p class='text-center'>No hay avances de asignación registrados con el nombre, tipo, lugar o progreso introducido.</p></div>"; ?></p>
      <?php
      }
    }

    public function newReportDocente(){
    // Se carga el modelo alumno
    $this->load->model('avances_model');
    // Se carga la libreria fpdf
    $this->load->library('pdf');
 
    // Se obtienen los alumnos de la base de datos
    $docente = $this->input->post('docente');
    $query = $this->avances_model->obtenerReporteDocente($docente);
 
    // Creacion del PDF
 
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Pdf();
    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    $this->pdf->SetTitle("Reporte de avances");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
    $this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'B', 9);
    /*
     * TITULOS DE COLUMNAS
     *
     * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
     */
 
    $this->pdf->Cell(10,7,'NUM','TBL',0,'C','1');
    $this->pdf->Cell(45,7,'DOCENTE','TB',0,'L','1');
    $this->pdf->Cell(20,7,'TIPO','TB',0,'L','1');
    $this->pdf->Cell(40,7,'ACTIVIDAD','TB',0,'L','1');
    $this->pdf->Cell(25,7,'FECHA INICIO','TB',0,'C','1');
    $this->pdf->Cell(20,7,'FECHA FIN','TB',0,'L','1');
    $this->pdf->Cell(25,7,'PROGRESO','TBR',0,'C','1');
    $this->pdf->Ln(7);
    // La variable $x se utiliza para mostrar un número consecutivo
    $x = 1;
    foreach ($query as $row){
      // se imprime el numero actual y despues se incrementa el valor de $x en uno
      $this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
      // Se imprimen los datos de cada alumno
      $this->pdf->Cell(45,5,utf8_decode($row->Nombres),'B',0,'L',0);
      $this->pdf->Cell(20,5,utf8_decode($row->Tipo),'B',0,'L',0);
      $this->pdf->Cell(40,5,utf8_decode($row->Nombre),'B',0,'L',0);
      $this->pdf->Cell(25,5,$row->Fecha_Inicio,'B',0,'C',0);
      $this->pdf->Cell(20,5,$row->Fecha_Fin,'B',0,'L',0);
      $this->pdf->Cell(25,5,$row->Avance,'BR',0,'C',0);
      //Se agrega un salto de linea
      $this->pdf->Ln(5);
    }
    /*
     * Se manda el pdf al navegador
     *
     * $this->pdf->Output(nombredelarchivo, destino);
     *
     * I = Muestra el pdf en el navegador
     * D = Envia el pdf para descarga
     *
     */
    $this->pdf->Output("Reporte.pdf", 'D');
  }

    public function newReportPeriodo(){
    $this->load->model('avances_model');
    $this->load->library('pdf');
 
    $fechainiR = $this->input->post('fechainiR');
    $fechafinR = $this->input->post('fechafinR');
    $query = $this->avances_model->obtenerReporteFechas($fechainiR, $fechafinR);
 
    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->AliasNbPages();
    $this->pdf->SetTitle("Reporte de avances");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
    $this->pdf->SetFillColor(200,200,200);
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(10,7,'NUM','TBL',0,'C','1');
    $this->pdf->Cell(45,7,'DOCENTE','TB',0,'L','1');
    $this->pdf->Cell(20,7,'TIPO','TB',0,'L','1');
    $this->pdf->Cell(40,7,'ACTIVIDAD','TB',0,'L','1');
    $this->pdf->Cell(25,7,'FECHA INICIO','TB',0,'C','1');
    $this->pdf->Cell(20,7,'FECHA FIN','TB',0,'L','1');
    $this->pdf->Cell(25,7,'PROGRESO','TBR',0,'C','1');
    $this->pdf->Ln(7);

    $x = 1;
    foreach ($query as $row){
      $this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
      $this->pdf->Cell(45,5,utf8_decode($row->Nombres),'B',0,'L',0);
      $this->pdf->Cell(20,5,utf8_decode($row->Tipo),'B',0,'L',0);
      $this->pdf->Cell(40,5,utf8_decode($row->Nombre),'B',0,'L',0);
      $this->pdf->Cell(25,5,$row->Fecha_Inicio,'B',0,'C',0);
      $this->pdf->Cell(20,5,$row->Fecha_Fin,'B',0,'L',0);
      $this->pdf->Cell(25,5,$row->Avance,'BR',0,'C',0);
      $this->pdf->Ln(5);
    }
    
    $this->pdf->Output("Reporte.pdf", 'D');
  }

}