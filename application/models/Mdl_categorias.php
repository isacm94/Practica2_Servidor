<?php

class Mdl_categorias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                                    . "FROM categoria "
                                        . "WHERE mostrar = 1; ");
        
        return $query->result_array();
    }
    
    public function getUnaCategoria($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, nombre_cat, descripcion "
                                        . "FROM categoria "
                                            . "WHERE mostrar = 1 "
                                                . "AND idCategoria = $idCategoria; ");
        
        return $query->result_array();
    }
    
    public function getCamisetasFromCategoria($idCategoria) {

        $query = $this->db->query("SELECT idCamiseta, descripcion, imagen, precio, descuento "
                                    . "FROM camiseta "
                                            . "WHERE mostrar = 1 "
                                                . "AND curdate() >= fecha_inicio "
                                                    . "AND curdate() <= fecha_fin "
                                                        . "AND idCategoria = $idCategoria; ");
        
        return $query->result_array();
    }
}
