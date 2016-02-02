<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_pedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getDatosFromUserName($username) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', correo "
                . "FROM usuario "
                . "WHERE nombre_usu LIKE '$username'; ");

        return $query->result_array()[0];
    }

    public function getDatosFromId($id) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', correo "
                . "FROM usuario "
                . "WHERE idUsuario LIKE '$id'; ");
        if(count($query->result_array()) > 0)
            return $query->result_array()[0];
        else
            return -1;
    }

    public function UpdateClave($username, $clave) {
        $data = array(
            'clave' => $clave
        );
        $this->db->where('nombre_usu', $username);
        $this->db->update('usuario', $data);
    }

}
