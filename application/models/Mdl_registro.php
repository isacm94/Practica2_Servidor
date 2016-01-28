<?php

class Mdl_registro extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCount_NombreUsuario($nombre_usu) {

        $query = $this->db->query("SELECT count(*) as cont "
                                    . "FROM usuario "
                                        . "WHERE nombre_usu = '$nombre_usu'; ");
        
        return $query->result_array();
    }
    
    public function setUsuario($data){
        
        $this->db->insert('usuario', $data);
    }
}


