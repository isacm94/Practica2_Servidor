<?php

/**
 * MODELO que gestiona los datos para importar y exportar en XML y en Excel
 */
class Mdl_xml extends CI_Model {

    public function __construct() {
        $this->load->database();
        //$this->load->helper('db');
    }
    
    /**
     * Consulta todas las camisetas de una categoría
     * @param Int $idCat ID de la categoría
     * @return Array
     */
    public function getCamisetas($idCat){
        $query = $this->db->query("SELECT cod_camiseta, nombre_cam, precio, descuento, imagen, iva, "
                                    . "descripcion, seleccionada, mostrar, fecha_inicio, fecha_fin, stock "
                                        . "FROM camiseta "
                                            . "WHERE idCategoria = $idCat ");
        
        return $query->result_array();
    }
    
    /**
     * Consulta todas las categorías
     * @return Array
     */
    public function getCategorias(){
                $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion, mostrar "
                                    . "FROM categoria ");
        
        return $query->result_array();
    }
    
    /**
     * Añade una categoría a la base de datos
     * @param Array $data Datos para insertar
     * @return Int ID que tiene la categoría insertada
     */
    public function addCategoria($data) {

        $this->db->insert('categoria', $data);
        
        return $this->db->insert_id();//Devuelve el id de la categoría insertada
    }
    
    /**
     * Añade una camiseta a la base de datos
     * @param Array $data Datos para insertar
     */
    public function addCamiseta($data) {

        $this->db->insert('camiseta', $data);
    }
}
