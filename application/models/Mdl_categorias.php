<?php

/**
 * MODELO de la consultas relacionadas con la tabla categoría.
 */
class Mdl_categorias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve toda las categorías que se puedan mostrar
     * @return Array
     */
    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1; ");

        return $query->result_array();
    }

    /**
     * Devuelve una categoría
     * @param ID $idCategoria ID de la categoría
     * @return Array
     */
    public function getUnaCategoria($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria ");


        return $query->row_array();
    }

    /**
     * Devuelve las camisetas que se puedan mostrar de una categoría
     * @param Int $idCategoria ID de la cantegoría
     * @param Int $limit Hasta donde te devuelve
     * @param Int $start Desde donde te devuelve
     * @return Array
     */
    public function getCamisetasFromCategoria($idCategoria, $limit, $start) {

        $query = $this->db->query("SELECT idCamiseta, descripcion, imagen, precio, descuento "
                . "FROM camiseta "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND stock > 0 "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Devuelve el número de camisetas que tiene una categoria
     * @param Int $idCategoria ID de la categoría
     * @return Int Nº Camisetas
     */
    public function getNumTotalCamisetasFromCategoria($idCategoria) {
        $query = $this->db->query("SELECT idCamiseta "
                . "FROM camiseta "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND stock > 0 ");

        return $query->num_rows();
    }

}
