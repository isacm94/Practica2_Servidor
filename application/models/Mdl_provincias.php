<?php

/**
 * MODELO de la consultas de provincias.
 */
class Mdl_provincias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getProvincias() {

        $query = $this->db->query("SELECT cod, nombre "
                                    . "FROM provincias ");
        
        return $query->result_array();
    }      
    
    public function getNombreProvincia($cod) {

        $query = $this->db->query("SELECT nombre "
                                    . "FROM provincias "
                                        . "WHERE cod = $cod");
        
        return $query->result_array()[0]['nombre'];
    }
}
