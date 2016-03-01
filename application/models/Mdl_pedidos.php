<?php

/**
 * MODELO que gestiona los pedidos
 */
class Mdl_pedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('Mdl_carrito');
    }

    /**
     * Añade un pedio a la base de datos
     * @param Array $dataPedido Datos del pedido
     * @return Int ID del pedido insertado
     */
    public function insertPedido($dataPedido) {
        $this->db->insert('pedido', $dataPedido);

        return $this->db->insert_id();
    }

    /**
     * Añade una línea de pedido a la base de datos
     * @param Array $data Datos de la línea de pedido
     */
    public function insertLineaPedido($data) {
        $this->db->insert('linea_pedido', $data);
    }

    /**
     * Consulta los datos necesarios del usuario para hacer el pedido
     * @param Int $id ID del usuario
     * @return Array
     */
    public function getDatosParaPedido($id) {
        $query = $this->db->query("SELECT direccion, cp, cod_provincia, correo "
                . "FROM usuario "
                . "WHERE idUsuario = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos necesarios del usuario para crear el documento PDF
     * @param Int $id ID del usuario
     * @return Array
     */
    public function getDatosParaPDF($id) {
        $query = $this->db->query("SELECT nombre_persona, apellidos_persona, dni, direccion, cp, p.nombre 'provincia' "
                . "FROM usuario u "
                . "INNER JOIN provincias p on u.cod_provincia = p.cod "
                . "WHERE idUsuario = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta el IVA de una camiseta
     * @param Int $id ID de la camiseta
     * @return Float
     */
    public function getIva($id) {
        $query = $this->db->query("SELECT iva "
                . "FROM camiseta "
                . "WHERE idcamiseta = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta un pedido de un usuario
     * @param Int $id ID del pedido
     * @param Int $iduser ID del usuario
     * @return Array
     */
    public function getPedido($id, $iduser) {
        $query = $this->db->query("SELECT importe, cantidad_total, estado, fecha_pedido "
                . "FROM pedido "
                . "WHERE idPedido = $id "
                . "AND idUsuario = $iduser; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos de envío de un pedido
     * @param Int $id ID del pedido
     * @return Array
     */
    public function getDatosEnvio($id) {
        $query = $this->db->query("SELECT direccion, cp, cod_provincia  "
                . "FROM pedido "
                . "WHERE idPedido = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta todas las líneas de pedido que tiene un pedido
     * @param Int $id ID del pedido
     * @return Array 
     */
    public function getLineasPedidos($id) {

        $query = $this->db->query("SELECT cam.imagen, cam.descripcion, cam.nombre_cam, cantidad, li.precio, importe, li.iva  "
                . "FROM linea_pedido li "
                . "INNER JOIN camiseta cam on li.idCamiseta = cam.idCamiseta "
                . "WHERE li.idPedido = $id; ");

        return $query->result_array();
    }

    /**
     * Disminuye el stock de una camiseta cuando se realiza la compra
     * @param Int $idCamiseta ID de la camiseta
     * @param Int $cantidad Cantidad a disminuir
     */
    public function CambiaStock($idCamiseta, $cantidad) {
        $stock = $this->Mdl_carrito->getStock($idCamiseta);

        $stock = $stock - $cantidad;

        $data = array(
            'stock' => $stock
        );
        $this->db->where('idCamiseta', $idCamiseta);
        $this->db->update('camiseta', $data);
    }

}
