<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_MisPedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getPedidos($iduser/* $limit, $start*/) {
        $query = $this->db->query("SELECT *, pr.nombre 'nom_provincia' "
                . "FROM pedido pe "
                . "INNER JOIN provincias pr on pr.cod = pe.cod_provincia "
                . "WHERE idUsuario = $iduser ");

        return $query->result_array();
    }

    public function getCountPedidos($iduser) {
        $query = $this->db->query("SELECT count(*)cont "
                . "FROM pedido "
                . "WHERE idUsuario = $iduser; ");

        return $query->row_array()['cont'];
    }

    public function getEstado($idpedido) {
        $query = $this->db->query("SELECT estado "
                . "FROM pedido "
                . "WHERE idPedido = $idpedido; ");

        return $query->row_array()['estado'];
    }

    public function setAnulado($idPedido) {
        $data = array(
            'estado' => 'Anulado'
        );
        $this->db->where('idPedido', $idPedido);
        $this->db->update('pedido', $data);
    }

}
