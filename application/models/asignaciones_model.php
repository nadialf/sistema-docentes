<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignaciones_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();

    }

    function getAsignaciones(){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, asignaciones.Fecha_Incorporacion, asignaciones.ID_Asignacion');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->order_by("Fecha_Incorporacion","desc");
        $query = $this->db->get();
        return $query->result();
    }

    function getAsignacionesID($id){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, asignaciones.Fecha_Incorporacion, asignaciones.ID_Asignacion');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->where('ID_Asignacion', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function saveAsignacion($docente, $tipo, $actividad, $fecha){  
        $this->db->select('ID_Trabajador, CONCAT(Nombres," ",ApPaterno," ",ApMaterno) AS name', FALSE);
        $this->db->from('trabajadores');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            if ($row->name == $docente) {
                $ID_Trabajador = $row->ID_Trabajador;
            }
        }
        
        $this->db->select();
        $this->db->where('Nombre', $actividad);
        $query2 = $this->db->get('actividades');
        if ($query2->num_rows() == 1) {
            foreach ($query2->result() as $row) {
                $ID_Actividad = $row->ID_Actividad;
            }
        }

        $fecha = getdate();
        $fechaactual = "$fecha[year]/$fecha[mon]/$fecha[mday]";

        $array = array(
            'ID_Actividad' => $ID_Actividad,
            'ID_Trabajador' => $ID_Trabajador,
            'Fecha_Incorporacion' => $fechaactual
            );
        
        $this->db->insert('asignaciones', $array);
    }

    function updateAsig($id, $docente, $tipo, $actividad){
        $this->db->select('ID_Trabajador, CONCAT(Nombres," ",ApPaterno," ",ApMaterno) AS name', FALSE);
        $this->db->from('trabajadores');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            if ($row->name == $docente) {
                $ID_Trabajador = $row->ID_Trabajador;
            }
        }
        
        $this->db->select();
        $this->db->where('Nombre', $actividad);
        $query2 = $this->db->get('actividades');
        if ($query2->num_rows() == 1) {
            foreach ($query2->result() as $row) {
                $ID_Actividad = $row->ID_Actividad;
            }
        }

        $datos = array('ID_Actividad' => $ID_Actividad,
                       'ID_Trabajador' => $ID_Trabajador
                       );
        $this->db->where('ID_Asignacion', $id);
        $this->db->update('asignaciones', $datos);

        redirect(base_url().'asignaciones');
    }

    function deleteAsig($id){
        $this->db->where('ID_Asignacion', $id);
        $this->db->delete('asignaciones');
        redirect(base_url().'asignaciones');
    }

    function deleteAsig2($id, $docente){
        $this->db->where('ID_Asignacion', $id);
        $this->db->delete('asignaciones');
        redirect(base_url().'actividades/act_doc/'.$docente);
    }

    function getDocentes($q){
        $this->db->select();
        $this->db->like('Nombres', $q);
        $this->db->or_like('ApPaterno', $q);
        $this->db->or_like('ApMaterno', $q);
        $query = $this->db->get('trabajadores');
        $query->num_rows();

        if($query->num_rows > 0){
            foreach ($query->result() as $row){
                $new_row['id'] = htmlspecialchars($row->ID_Trabajador);
                $new_row['value'] = htmlspecialchars($row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno);
                $row_set[] = $new_row;
            }
            return $row_set;
        }
    }

    function getActividades($q, $tipo){
        if ($tipo == "") {
            $new_row['id'] = htmlentities(stripslashes(0));
            $new_row['value'] = htmlentities(stripslashes("Seleccione el tipo de actividad"));
            $row_set[] = $new_row;
            return $row_set;
        }
        $this->db->select();
        $this->db->like('Nombre', $q);
        $query = $this->db->get('actividades');
        $query->num_rows();

        if($query->num_rows > 0){
            foreach ($query->result() as $row){
                if($row->Tipo == $tipo){
                    $new_row['id'] = htmlspecialchars($row->ID_Actividad);
                    $new_row['value'] = htmlspecialchars($row->Nombre);
                    $row_set[] = $new_row;
                }else{
                    $new_row['id'] = htmlspecialchars($row->ID_Actividad);
                    $new_row['value'] = htmlspecialchars("La actividad no pertenece al tipo seleccionado");
                    $row_set[] = $new_row;
                }
                
            }
            return $row_set;
        }
    }

    public function buscador($abuscar){
        $this->db->select('trabajadores.Nombres, trabajadores.ApPaterno, trabajadores.ApMaterno, actividades.Tipo, actividades.Nombre, asignaciones.Fecha_Incorporacion, asignaciones.ID_Asignacion');
        $this->db->from('asignaciones');
        $this->db->join('trabajadores', 'trabajadores.ID_Trabajador = asignaciones.ID_Trabajador');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('trabajadores.ApPaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.ApMaterno',$abuscar,'both');
        $this->db->or_like('trabajadores.Nombres',$abuscar,'both');
        $this->db->or_like('actividades.Tipo',$abuscar,'both');
        $this->db->or_like('actividades.Nombre',$abuscar,'both');
        $this->db->order_by("Fecha_Incorporacion","desc");
        $resultados = $this->db->get();

        if($resultados->num_rows() > 0){
            return $resultados;
            
        }else{
            return FALSE;
        }
    }  
}