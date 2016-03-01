<?php

/**
 * MODELO de la consultas relacionadas con la tabla camiseta.
 */
class Mdl_camiseta extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve los datos de un camiseta
     * @param Int $idCamiseta ID de la camiseta
     * @return Array 
     */
    public function getCamiseta($idCamiseta) {

        $query = $this->db->query("SELECT idCamiseta, idCategoria, cod_camiseta, nombre_cam, descripcion, imagen, precio, descuento "
                . "FROM camiseta "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCamiseta = $idCamiseta; ");

        return $query->row_array();
    }

    /**
     * Devuelve la información de una categoría
     * @param Int $idCategoria ID de la categoría
     * @return Array
     */
    public function getInfoCategoriaFromCamiseta($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria; ");

        return $query->result_array();
    }

    /**
     * Función que dice si una camiseta se debe mostrar
     * @param Int $idCamiseta ID de la camiseta
     * @return boolean
     */
    public function SiSeDebeMostarCamiseta($idCamiseta) {

        $query = $this->db->query("SELECT count(*) as cont "
                . "FROM camiseta "
                . "WHERE idCamiseta = $idCamiseta ");

        $cont = $query->result_array()[0]['cont'];

        if ($cont > 0) {//Existe el idcamiseta
            $query2 = $this->db->query("SELECT cat.mostrar 'mostrarcat', cam.mostrar 'mostrarcam' "
                    . "FROM camiseta cam "
                    . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                    . "WHERE idCamiseta = $idCamiseta ");

            $datos = $query2->result_array();

            if ($datos[0]['mostrarcat'] == 1 && $datos[0]['mostrarcam'] == 1)//Se debe mostrar la camiseta
                return true;
            else {
                return false;
            }
        } else//No existe el idcamiseta
            return false;
    }

    /**
     * Devuelve camisetas relacionadas de una camiseta, es decir, las camisetas que tienen su misma categoría 
     * @param Int $idCategoria ID de la categoría
     * @param Int $idCamiseta ID de la camiseta
     * @return Array
     */
    public function getCamisetasRelacionadasFromCategoria($idCategoria, $idCamiseta) {

        $query = $this->db->query("SELECT idCamiseta, descripcion, imagen, precio, descuento "
                . "FROM camiseta "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND idCamiseta != $idCamiseta; ");

        return $query->result_array();
    }

}
