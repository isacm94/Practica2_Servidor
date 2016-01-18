<?php

class Mdl_seleccionadas extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getSeleccionadas() {

        $query = $this->db->query("SELECT cam.idCamiseta, cam.descripcion, cam.imagen, cam.precio, cam.descuento "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND cam.seleccionada = 1 "
                . "AND cam.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin; ");


        return $query->result_array();
    }

}
