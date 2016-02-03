<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_pedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insertPedido($dataPedido) {
        $this->db->insert('pedido', $dataPedido);
    }
    
    public function insertLineaPedido($dataPedido) {
        $this->db->insert('linea_pedido', $dataPedido);
    }
    
    //consulta datos necesarios del usuario para hacer el pedidos
    public function getDatosParaPedido($id){
        $query = $this->db->query("SELECT direccion, cp, cod_provincia, correo "
                                    . "FROM usuario "
                                        . "WHERE idUsuario = $id; ");
        
        return $query->result_array()[0];
    }
    
    public function getCountPedidos(){
        return $this->db->count_all('pedido');
    }

    public function getIva($id){
        $query = $this->db->query("SELECT iva "
                                    . "FROM camiseta "
                                        . "WHERE idcamiseta = $id; ");
        
        return $query->result_array()[0];
    }
}
