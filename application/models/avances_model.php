<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avances_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getAvances(){
        $this->db->select('ID_Actividad, Fecha_Inicio, Fecha_Fin');
        $this->db->from('actividades');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $ID_Actividad = $row->ID_Actividad;

            $fecha = getdate();
            $fechaactual = "$fecha[year]-$fecha[mon]-$fecha[mday]";

            $fechahoy = new DateTime($fechaactual);
            $fechaini = new DateTime($row->Fecha_Inicio);
            $fechafin = new DateTime($row->Fecha_Fin);

            if ($fechahoy < $fechaini){
                $progreso = "Por comenzar";
            } elseif ( ($fechahoy >= $fechaini) && ($fechahoy <= $fechafin) ){
                 $progreso = "En curso";
            } elseif ($fechahoy > $fechafin){
                 $progreso = "Terminada";
            }

            $datos = array('Avance' => $progreso);
            $this->db->where('ID_Actividad', $ID_Actividad);
            $this->db->update('asignaciones', $datos);
        }


        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, actividades.Fecha_Inicio, actividades.Fecha_Fin, asignaciones.ID_Asignacion, asignaciones.Avance');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->order_by("actividades.Fecha_Inicio","desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function buscador($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, actividades.Fecha_Inicio, asignaciones.ID_Asignacion, asignaciones.Avance');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('trabajadores.ApPaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.ApMaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('actividades.Tipo',$abuscar,'both');
        $this->db->or_like('actividades.Nombre',$abuscar,'both');
        $this->db->or_like('asignaciones.Avance',$abuscar,'both');
        $this->db->order_by("actividades.Fecha_Inicio","desc");
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    }

}