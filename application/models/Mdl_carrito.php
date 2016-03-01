<?php

/**
 * MODELO de la consultas relacionadas con el carrito.
 */
class Mdl_carrito extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve los datos de una camiseta para usarlo en el carrito
     * @param Int $id ID de la camiseta
     * @return Array
     */
    public function getDataCamiseta($id) {

        $query = $this->db->query("SELECT idCamiseta, precio, descuento, descripcion, imagen "
                                    . "FROM camiseta "
                                        . "WHERE idCamiseta = $id; ");
        
        return $query->row_array();
    }
    
    /**
     * Devuelve el stock de una camiseta
     * @param Int $id ID de la camiseta
     * @return Int
     */
    public function getStock($id){
        $query = $this->db->query("SELECT stock "
                                    . "FROM camiseta "
                                        . "WHERE idCamiseta = $id; ");
        
        return $query->row_array()['stock'];
        
    }
}
