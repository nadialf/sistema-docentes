<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getActividades(){
        $this->db->order_by("Fecha_Inicio","desc");
        $query = $this->db->get('actividades');
        return $query->result();

    }

    function getActividadesID($id){
        $this->db->select();
        $this->db->where('ID_Actividad', $id);
        $query = $this->db->get('actividades');
        return $query->result();
    }

    function agregarActividad($nombre, $tipo, $lugar, $fechaini, $fechafin){
        $datos = array('Nombre' => $nombre,
                        'Tipo' => $tipo,
                        'Lugar' => $lugar,
                        'Fecha_Inicio' => $fechaini,
                        'Fecha_Fin' => $fechafin);
        $this->db->insert('actividades', $datos);
        redirect(base_url().'actividades/act_admin');
    }

    function updateAct($id, $nombre, $tipo, $lugar, $fechaini, $fechafin){
        $datos = array('ID_Actividad' => $id,
                        'Nombre' => $nombre,
                        'Tipo' => $tipo,
                        'Lugar' => $lugar,
                        'Fecha_Inicio' => $fechaini,
                        'Fecha_Fin' => $fechafin);
        $this->db->where('ID_Actividad', $id);
        $this->db->update('actividades', $datos);

        redirect(base_url().'actividades/act_admin');
    }

    function deleteAct($id){
        $this->db->where('ID_Actividad', $id);
        $this->db->delete('actividades');
        redirect(base_url().'actividades/act_admin');
    }


    public function buscador($abuscar){
    	//usamos after para decir que empiece a buscar por
    	//el principio de la cadena
    	//ej SELECT localidad from localidades_es
    	//WHERE localidad LIKE '%$abuscar' limit 12

    	$this->db->select();
    	$this->db->like('Nombre',$abuscar,'both');
    	$this->db->or_like('Tipo',$abuscar,'both');
    	$this->db->or_like('Lugar',$abuscar,'both');
        $this->db->order_by("Fecha_Inicio","desc");
    	$resultados = $this->db->get('actividades', 22);

    	//si existe algún resultado lo devolvemos
    	if($resultados->num_rows() > 0){
    		return $resultados;
    		//en otro caso devolvemos false
    	}else{
    		return FALSE;
    	}
    }

}