<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getCorreos(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, correos.ID_Correo, correos.Asunto, correos.Leido');
        $this->db->from('correos');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = correos.ID_Remitente');
        $query = $this->db->get();
        return $query->result();
    }

    public function buscador($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, correos.ID_Correo, correos.Asunto, correos.Leido');
        $this->db->from('correos');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = correos.ID_Remitente');
        $this->db->like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('trabajadores.ApPaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.ApMaterno',$abuscar,'both');
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    }  

}