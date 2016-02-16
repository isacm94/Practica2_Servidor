<?php

/**
 * MODELO relacionado con las consultas, insercción y actualización de la tabla usuario.
 */
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
    
    //Te devuelve los datos que se van a modificar para mostrarlos en el formualario
    public function getDatosModificar($nombre_usu) {

        $query = $this->db->query("SELECT idUsuario, nombre_usu, correo, direccion, cp, cod_provincia "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu'");
                    

        return $query->row_array();
    }
    
    public function getCount_NombreUsuarioModificar($nombre_usu, $idUsuario) {

        $query = $this->db->query("SELECT count(*) as cont "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' "
                . "AND estado = 'A' "
                . "AND idUsuario != $idUsuario; ");

        return $query->result_array()[0]['cont'];
    }
    
    public function getId($nombre_usu) {

        $query = $this->db->query("SELECT idUsuario "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' ");

        return $query->result_array()[0]['idUsuario'];
    }
    
    public function updateUsuario($id, $data) {
        $this->db->where('idUsuario', $id);
        $this->db->update('usuario', $data);
    }
}
