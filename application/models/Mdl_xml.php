<?php

/**
 * MODELO 
 */
class Mdl_xml extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function getCamisetas($idCat){
        $query = $this->db->query("SELECT cod_camiseta, nombre_cam, precio, descuento, imagen, iva, "
                                    . "descripcion, seleccionada, mostrar, fecha_inicio, fecha_fin, stock "
                                        . "FROM camiseta "
                                            . "WHERE idCategoria = $idCat ");
        
        return $query->result_array();
    }
    
    public function getCategorias(){
                $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion, mostrar "
                                    . "FROM categoria ");
        
        return $query->result_array();
    }
}
