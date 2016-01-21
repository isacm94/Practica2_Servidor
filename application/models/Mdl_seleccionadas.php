<?php

class Mdl_seleccionadas extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getSeleccionadas($limit, $start) {
        $this->db->limit($limit,$start);
        $query = $this->db->query("SELECT cam.idCamiseta, cam.descripcion, cam.imagen, cam.precio, cam.descuento "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND cam.seleccionada = 1 "
                . "AND cam.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "LIMIT $start, $limit; ");


        return $query->result_array();
    }
    
    public function getNumTotalCamisetas(){
        
        return $this->db->count_all('camiseta');
    }

}
