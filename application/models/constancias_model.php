<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Constancias_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getSolicitudesAceptadas(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, solicitudes.ID_Solicitud, solicitudes.Etapa');
        $this->db->from('solicitudes');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = solicitudes.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = solicitudes.ID_Actividad');
        $this->db->where('Aceptada', '1');
        $this->db->order_by("ID_Solicitud","desc");
        $query = $this->db->get();
        return $query->result();
    }

    function getSolicitudesNoAceptadas(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, solicitudes.ID_Solicitud, solicitudes.Etapa');
        $this->db->from('solicitudes');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = solicitudes.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = solicitudes.ID_Actividad');
        $this->db->where('Aceptada', '0');
        $this->db->order_by("ID_Solicitud","desc");
        $query = $this->db->get();
        return $query->result();
    }

    function getSolicitudID($id){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, actividades.Fecha_Inicio, actividades.Fecha_Fin, solicitudes.ID_Solicitud, solicitudes.Etapa
            ');
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

    function upload_constancia($id) {
        $this->db->select();
        $this->db->where('ID_Solicitud', $id);
        $query = $this->db->get('constancias');

        if ($query->num_rows() == 0){
            $datos = array('Formato' => "Si",
                        'ID_Solicitud' => $id);
            $this->db->insert('constancias', $datos);

            $datos = array('Etapa' => "Firmada",
                                'ID_Solicitud' => $id);
                    $this->db->where('ID_Solicitud', $id);
                    $this->db->update('solicitudes', $datos);
        }          
        redirect(base_url().'constancias/cons_direc');
    }

    function deleteSolicitud($id){
        $this->db->where('ID_Solicitud', $id);
        $this->db->delete('solicitudes');
        redirect(base_url().'constancias/cons_admin');
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

    public function buscadorDirector($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, solicitudes.ID_Solicitud, solicitudes.Etapa, solicitudes.Aceptada');
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

    function changeSolicitud1($id){
        $datos = array('Aceptada' => '0',
                        'Etapa' => 'En proceso');
        $this->db->where('ID_Solicitud', $id);
        $this->db->update('solicitudes', $datos);

        $this->db->where('ID_Solicitud', $id);
        $this->db->delete('constancias');

        redirect(base_url().'constancias/cons_admin');
    }

    function changeSolicitud2($id){
        $datos = array('Aceptada' => '1',
                        'Etapa' => 'Aceptada');
        $this->db->where('ID_Solicitud', $id);
        $this->db->update('solicitudes', $datos);

        redirect(base_url().'constancias/cons_admin');
    }

}