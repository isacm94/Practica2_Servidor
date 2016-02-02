<?php

/**
 * MODELO de la consultas relacionadas con la tabla camiseta.
 */
class Mdl_camiseta extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
      
    public function getCamiseta($idCamiseta) {

        $query = $this->db->query("SELECT idCamiseta, idCategoria, cod_camiseta, nombre_cam, descripcion, imagen, precio, descuento "
                . "FROM camiseta "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCamiseta = $idCamiseta; ");

        return $query->result_array();
    }

    public function getInfoCategoriaFromCamiseta($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria; ");

        return $query->result_array();
    }

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

    //Devuelve camisetas relacinadas de una camiseta 
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
