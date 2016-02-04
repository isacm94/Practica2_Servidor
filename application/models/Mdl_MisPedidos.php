<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_MisPedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

     
    public function getPedido($iduser){
        $query = $this->db->query("SELECT *, pr.nombre 'nom_provincia' "
                                    . "FROM pedido pe "
                                        . "INNER JOIN provincias pr on pr.cod = pe.cod_provincia "
                                        . "WHERE idUsuario = $iduser; ");
        
        return $query->result_array();
    }
}
