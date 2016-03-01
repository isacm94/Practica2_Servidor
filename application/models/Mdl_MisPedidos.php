<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_MisPedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('Mdl_carrito');
    }

    /**
     * Devuelve todos los pedidos de un usuario
     * @param Int $iduser ID del usuario
     * @return Array Datos
     */
    public function getPedidos($iduser) {
        $query = $this->db->query("SELECT *, pr.nombre 'nom_provincia' "
                . "FROM pedido pe "
                . "INNER JOIN provincias pr on pr.cod = pe.cod_provincia "
                . "WHERE idUsuario = $iduser ");

        return $query->result_array();
    }

    /**
     * Devuelve número de pedidos de un usuario
     * @param Int $iduser ID del usuario
     * @return Int Nº pedidos
     */
    public function getCountPedidos($iduser) {
        $query = $this->db->query("SELECT count(*)cont "
                . "FROM pedido "
                . "WHERE idUsuario = $iduser; ");

        return $query->row_array()['cont'];
    }

    /**
     * Devuelve el estado de un pedido
     * @param Int $idpedido ID del pedido
     * @return String Estado
     */
    public function getEstado($idpedido) {
        $query = $this->db->query("SELECT estado "
                . "FROM pedido "
                . "WHERE idPedido = $idpedido; ");

        return $query->row_array()['estado'];
    }

    /**
     * Establece un pedido nulo, es decir, cambia su estado a 'Anulado'
     * @param Int $idPedido ID del pedido
     */
    public function setAnulado($idPedido) {
        $data = array(
            'estado' => 'Anulado'
        );
        $this->db->where('idPedido', $idPedido);
        $this->db->update('pedido', $data);
    }

    /**
     * Devuelve la cantidad de cada camiseta de un pedido
     * @param Int $idPedido ID del pedido
     * @return Array
     */
    public function getCantidad($idPedido) {
        $query = $this->db->query("SELECT cantidad, idCamiseta  "
                . "FROM linea_pedido "
                . "WHERE idPedido = $idPedido; ");

        return $query->result_array();
    }

    /**
     * Actualiza el stock de una camiseta después de anular un pedido
     * @param Int $idCamiseta ID de la camiseta
     * @param Int $cantidad Cantidad a actualizar
     */
    public function CambiaStock($idCamiseta, $cantidad) {
        $stock = $this->Mdl_carrito->getStock($idCamiseta);

        $stock = $stock + $cantidad;

        $data = array(
            'stock' => $stock
        );
        $this->db->where('idCamiseta', $idCamiseta);
        $this->db->update('camiseta', $data);
    }

}
