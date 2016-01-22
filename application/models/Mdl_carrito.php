<?php

class Mdl_carrito extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getDataCamiseta($id) {

        $query = $this->db->query("SELECT idCamiseta, precio, descuento, descripcion, imagen "
                                    . "FROM camiseta "
                                        . "WHERE idCamiseta = $id; ");
        
        return $query->result_array();
    }
}
