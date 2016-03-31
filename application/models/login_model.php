<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
 
    public function validate($usuario, $contrasena){
        print_r($usuario);
        $this->db->select('tipousuario');
        $this->db->from('cuentas');
        $this->db->where('usuario', $usuario);
        $this->db->where('contrasena', $contrasena);
        $query = $this->db->get();
        foreach($query->result() as $row) {
            $tipo = $row->tipousuario;
        }

        if ($tipo == "1") {
            redirect(base_url().'welcome_message/admin');    
        } if ($tipo == "2") {
            redirect(base_url().'welcome_message/director');    
        } if ($tipo == "3") {
            redirect(base_url().'welcome_message/docente');    
        }else {
            redirect(base_url());
        }
    }

}
