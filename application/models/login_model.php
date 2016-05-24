<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function validate($usuario, $contrasena){
    //print_r($usuario);
        $this->db->select('TipoUsuario,ID_Cuenta');
        $this->db->from('cuentas');
        $this->db->where('usuario', $usuario);
        $this->db->where('contrasena', $contrasena);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach($query->result() as $row) {
                $tipo = $row->TipoUsuario;
                $id = $row->ID_Cuenta;

                if ($tipo == "1") {
                redirect(base_url().'welcome_message/admin');    
                } elseif ($tipo == "2") {
                    redirect(base_url().'welcome_message/director/'.$row->ID_Cuenta);    
                } elseif ($tipo == "3") {
                    redirect(base_url().'welcome_message/docente/'.$row->ID_Cuenta);
                }
            }
        }else{
            redirect(base_url());
        }
    }
}
