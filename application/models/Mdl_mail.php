<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_mail extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getDatosFromUserName($username) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', correo "
                . "FROM usuario "
                . "WHERE nombre_usu LIKE '$username'; ");

        return $query->row_array();
    }

}