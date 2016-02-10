<?php

/**
 * MODELO 
 */
class Mdl_xml extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function getCamisetas(){
        $query = $this->db->query("SELECT * "
                                    . "FROM camiseta; ");
        
        return $query->result_array();
    }
    
    public function getCategorias(){
        $query = $this->db->query("SELECT * "
                                    . "FROM categoria; ");
        
        return $query->result_array();
    }
}
