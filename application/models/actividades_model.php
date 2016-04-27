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

    function getActividadesAvances(){
        $this->db->select('ID_Actividad, Fecha_Inicio, Fecha_Fin');
        $this->db->from('actividades');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $ID_Actividad = $row->ID_Actividad;

            $fecha = getdate();
            $fechaactual = "$fecha[year]-$fecha[mon]-$fecha[mday]";

            $fechahoy = new DateTime($fechaactual);
            $fechaini = new DateTime($row->Fecha_Inicio);
            $fechafin = new DateTime($row->Fecha_Fin);

            if ($fechahoy < $fechaini){
                $progreso = "Por comenzar";
            } elseif ( ($fechahoy >= $fechaini) && ($fechahoy <= $fechafin) ){
                 $progreso = "En curso";
            } elseif ($fechahoy > $fechafin){
                 $progreso = "Terminada";
            }

            $datos = array('Avance' => $progreso);
            $this->db->where('ID_Actividad', $ID_Actividad);
            $this->db->update('asignaciones', $datos);
        }

        $this->db->distinct();
        $this->db->select('actividades.ID_Actividad, actividades.Tipo, actividades.Nombre, actividades.Lugar, actividades.Fecha_Inicio, actividades.Fecha_Fin, actividades.Descripcion, asignaciones.ID_Asignacion, asignaciones.Avance');
        $this->db->from('asignaciones');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');
        $this->db->order_by("actividades.Fecha_Inicio","desc");
        $this->db->group_by('ID_Actividad');
        $query = $this->db->get();
        return $query->result();
    }

    function agregarActividad($nombre, $tipo, $lugar, $fechaini, $fechafin, $descripcion){
        $datos = array('Nombre' => $nombre,
                        'Tipo' => $tipo,
                        'Lugar' => $lugar,
                        'Fecha_Inicio' => $fechaini,
                        'Fecha_Fin' => $fechafin,
                        'Descripcion' => $descripcion);
        $this->db->insert('actividades', $datos);
        redirect(base_url().'actividades/act_admin');
    }

    function updateAct($id, $nombre, $tipo, $lugar, $fechaini, $fechafin, $descripcion){
        $datos = array('ID_Actividad' => $id,
                        'Nombre' => $nombre,
                        'Tipo' => $tipo,
                        'Lugar' => $lugar,
                        'Fecha_Inicio' => $fechaini,
                        'Fecha_Fin' => $fechafin,
                        'Descripcion' => $descripcion);
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

    public function buscador2($abuscar){
        $this->db->distinct();
        $this->db->select('actividades.ID_Actividad, actividades.Tipo, actividades.Nombre, actividades.Lugar, actividades.Fecha_Inicio, actividades.Fecha_Fin, actividades.Descripcion, asignaciones.ID_Asignacion, asignaciones.Avance');
        $this->db->from('asignaciones');
        $this->db->join('actividades', 'actividades.ID_Actividad = asignaciones.ID_Actividad');

        $this->db->like('Nombre',$abuscar,'both');
        $this->db->or_like('Tipo',$abuscar,'both');
        $this->db->or_like('Lugar',$abuscar,'both');
        $this->db->or_like('Avance',$abuscar,'both');

        $this->db->order_by("actividades.Fecha_Inicio","desc");
        $this->db->group_by('ID_Actividad');

        $resultados = $this->db->get();
        if($resultados->num_rows() > 0){
            return $resultados;
        }else{
            return FALSE;
        }
    }

}