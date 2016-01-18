<?php

class Mdl_seleccionadas extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getSeleccionadas() {

        $query = $this->db->query("SELECT descripcion, imagen, precio, descuento "
                                    . "FROM camiseta "
                                        . "WHERE seleccionada = 1 "
                                            . "AND mostrar = 1 "
                                                . "AND curdate() >= fecha_inicio "
                                                    . "AND curdate() <= fecha_fin; ");
        
        return $query->result_array();
    }

}
