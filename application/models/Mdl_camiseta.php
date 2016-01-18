<?php

class Mdl_camiseta extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCamiseta($idCamiseta) {

        $query = $this->db->query("SELECT idCamiseta, idCategoria, cod_camiseta, nombre_cam, descripcion, imagen, precio, descuento "
                . "FROM camiseta "
                . "WHERE seleccionada = 1 "
                . "AND mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCamiseta = $idCamiseta; ");

        return $query->result_array();
    }

    public function getCategoriaFromCamiseta($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria; ");

        return $query->result_array();
    }

    public function SiSeDebeMostarCamiseta($idCamiseta) {

        $query = $this->db->query("SELECT cat.mostrar 'mostrarcat', cam.mostrar 'mostrarcam' "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE idCamiseta = $idCamiseta ");

        $datos = $query->result_array();

        if ($datos[0]['mostrarcat'] == 1 && $datos[0]['mostrarcam'] == 1)
            return true;
        else
            return false;
    }

}
