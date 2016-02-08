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
        
        return $query->row_array();
    }
    public function getDatosParaPDF($id){
        $query = $this->db->query("SELECT nombre_persona, apellidos_persona, dni, direccion, cp, p.nombre 'provincia' "
                                    . "FROM usuario u "
                                        . "INNER JOIN provincias p on u.cod_provincia = p.cod "
                                                . "WHERE idUsuario = $id; ");
        
        return $query->row_array();
    }
    public function getCountPedidos(){
        return $this->db->count_all('pedido');
    }

    public function getIva($id){
        $query = $this->db->query("SELECT iva "
                                    . "FROM camiseta "
                                        . "WHERE idcamiseta = $id; ");
        
        return $query->row_array();
    }
    
    public function getPedido($id, $iduser){
        $query = $this->db->query("SELECT importe, cantidad_total, estado, fecha_pedido "
                                    . "FROM pedido "
                                        . "WHERE idPedido = $id "
                                            . "AND idUsuario = $iduser; ");
        
        return $query->row_array();
    }
    
    public function getDatosEnvio($id){
        $query = $this->db->query("SELECT direccion, cp, cod_provincia  "
                                    . "FROM pedido "
                                        . "WHERE idPedido = $id; ");
        
        return $query->row_array();
    }
    
    public function getLineasPedidos($id){
        //iva?
        $query = $this->db->query("SELECT cam.imagen, cam.descripcion, cam.nombre_cam, cantidad, li.precio, importe, li.iva  "
                                    . "FROM linea_pedido li "
                                        . "INNER JOIN camiseta cam on li.idCamiseta = cam.idCamiseta "
                                            . "WHERE li.idPedido = $id; ");
        
        return $query->result_array();
    }
}
