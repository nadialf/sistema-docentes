<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Constancias_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getSolicitudes(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, solicitudes.ID_Solicitud');
        $this->db->from('solicitudes');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = solicitudes.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = solicitudes.ID_Actividad');
        $this->db->order_by("ID_Solicitud","desc");
        $query = $this->db->get();
        return $query->result();
    }

    function getSolicitudID($id){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, actividades.Fecha_Inicio, actividades.Fecha_Fin, solicitudes.ID_Solicitud');
        $this->db->from('solicitudes');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = solicitudes.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = solicitudes.ID_Actividad');
        $this->db->where('ID_Solicitud', $id);
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    }

    public function buscador($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, solicitudes.ID_Solicitud');
        $this->db->from('solicitudes');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = solicitudes.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = solicitudes.ID_Actividad');

        $this->db->like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('trabajadores.ApPaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.ApMaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('actividades.Tipo',$abuscar,'both');
        $this->db->or_like('actividades.Nombre',$abuscar,'both');
        
        $this->db->order_by("ID_Solicitud","desc");
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    } 

}