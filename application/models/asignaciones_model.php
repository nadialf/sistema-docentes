<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignaciones_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getAsignaciones(){
    	$this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, asignaciones.Fecha_Incorporacion, asignaciones.ID_Asignacion');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $query = $this->db->get();
        return $query->result();
    }

    function get_docente($q){
        $this->db->select();
        $this->db->like('Nombres', $q);
        $this->db->or_like('ApPaterno', $q);
        $this->db->or_like('ApMaterno', $q);
        $query = $this->db->get('trabajadores');
        $query->num_rows();

        if($query->num_rows > 0){
            foreach ($query->result() as $row){
                $new_row['id'] = htmlentities(stripslashes($row->ID_Trabajador));
                $new_row['value'] = htmlentities(stripslashes($row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno));
                $row_set[] = $new_row;
            }
            return $row_set;
        }
    }
}