<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

     function getActividades(){
        $query = $this->db->get('actividades');
        return $query->result();

    }

}