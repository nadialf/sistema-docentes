<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docentes_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getDocentes(){
    	$this->db->select('trabajadores.ID_Trabajador, trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, trabajadores.TipoTrabajo, cuentas.Usuario, cuentas.Contrasena');
        $this->db->from('trabajadores');
        $this->db->join('cuentas', 'cuentas.ID_Cuenta = trabajadores.ID_Cuenta');
        $this->db->order_by("Nombres","asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getDocentesID($id){
        $this->db->select('trabajadores.ID_Trabajador, trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, trabajadores.TipoTrabajo, cuentas.Usuario, cuentas.Contrasena');
        $this->db->from('trabajadores');
        $this->db->join('cuentas', 'cuentas.ID_Cuenta = trabajadores.ID_Cuenta');
        $this->db->where('ID_Trabajador', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function agregarDocente($nombre, $paterno, $materno, $tipot, $user, $contrasena){
        $datos = array('Usuario' => $user,
                        'Contrasena' => $contrasena,
        				'TipoUsuario' => "3");
        $this->db->insert('cuentas', $datos);

        $id=mysql_insert_id();

        $datos = array('Nombres' => $nombre,
                        'ApPaterno' => $paterno,
                        'ApMaterno' => $materno,
                        'TipoTrabajo' => $tipot,
                        'ID_Cuenta' => $id);
        $this->db->insert('trabajadores', $datos);
        redirect(base_url().'docentes/doc_admin');
    }

    function updateDoc($id, $nombre, $paterno, $materno, $tipot, $user, $contrasena){
        $datos = array('Nombres' => $nombre,
                        'ApPaterno' => $paterno,
                        'ApMaterno' => $materno,
                        'TipoTrabajo' => $tipot);
        $this->db->where('ID_Trabajador', $id);
        $this->db->update('trabajadores', $datos);

        $datos = array('Usuario' => $user,
                        'Contrasena' => $contrasena);
        $this->db->where('ID_Cuenta', $id);
        $this->db->update('cuentas', $datos);

        redirect(base_url().'docentes/doc_admin');
    }

    function deleteDoc($id){
        $this->db->where('ID_Trabajador', $id);
        $this->db->delete('trabajadores');

        $this->db->where('ID_Cuenta', $id);
        $this->db->delete('cuentas');
        
        redirect(base_url().'docentes/doc_admin');
    }

    public function buscador($abuscar){
    	$this->db->select('trabajadores.ID_Trabajador, trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, trabajadores.TipoTrabajo, cuentas.Usuario, cuentas.Contrasena');
        $this->db->from('trabajadores');
        $this->db->join('cuentas', 'cuentas.ID_Cuenta = trabajadores.ID_Cuenta');

    	$this->db->or_like('Nombres',$abuscar,'both');
    	$this->db->or_like('ApPaterno',$abuscar,'both');
    	$this->db->or_like('ApMaterno',$abuscar,'both');
    	$this->db->or_like('Usuario',$abuscar,'both');
        $this->db->order_by("Nombres","asc");
    	$resultados = $this->db->get();

    	if($resultados->num_rows() > 0){
    		return $resultados;
    	}else{
    		return FALSE;
    	}
    }

    public function guarda_correo($data){
        $this->db->insert('correos',$data);
    }
}