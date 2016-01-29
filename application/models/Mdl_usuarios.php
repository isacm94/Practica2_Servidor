<?php

class Mdl_usuarios extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCount_NombreUsuario($nombre_usu) {

        $query = $this->db->query("SELECT count(*) as cont "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' "
                . "AND estado = 'A'; ");

        return $query->result_array()[0]['cont'];
    }

    public function setUsuario($data) {

        $this->db->insert('usuario', $data);
    }

    public function getClave($username) {

        $query = $this->db->query("SELECT clave "
                . "FROM usuario "
                . "WHERE nombre_usu = '$username'; ");

        return $query->result_array()[0]['clave'];
    }

    public function setBajaUsuario($username) {
        $data = array(
            'estado' => 'B'
        );
        $this->db->where('nombre_usu', $username);
        $this->db->update('usuario', $data);
    }

}
