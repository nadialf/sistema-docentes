<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getCorreos(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, correos.ID_Correo, correos.Asunto, correos.Leido, correos.Fecha_Envio');
        $this->db->from('correos');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = correos.ID_Remitente');
        $this->db->order_by("correos.Fecha_Envio","desc");
        $query = $this->db->get();
        return $query->result();
    }

    function deleteMail($id){
        $this->db->where('ID_Correo', $id);
        $this->db->delete('correos');
        redirect(base_url().'correo/mail_admin');
    }

    public function buscador($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, correos.ID_Correo, correos.Asunto, correos.Leido, correos.Fecha_Envio');
        $this->db->from('correos');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = correos.ID_Remitente');
        $this->db->like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('trabajadores.ApPaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.ApMaterno',$abuscar,'both');
        $this->db->order_by("correos.Fecha_Envio","desc");
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    }  

}