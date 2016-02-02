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
    
}
