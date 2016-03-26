<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
 
    public function validate($usuario, $contrasena){
        print_r($usuario);
        $this->db->select();
        $this->db->where('usuario', $usuario);
        $this->db->where('contrasena', $contrasena);
        $query = $this->db->get('cuentas');

        if ($query->num_rows() == 1) {
            //return $query->row();
            redirect(base_url().'welcome_message');    
        }else{
            redirect(base_url());
        }
    }
}
