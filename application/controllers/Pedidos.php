<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * CONTROLADOR 
 */
class Pedidos extends CI_Controller {
    
    public function __construct() {
        parent::__construct();    
        $this->load->model('Mdl_pedidos'); //Cargamos modelo de camiseta
        $this->load->library('Carro', 0, 'myCarrito');
    }
    public function index() {
        $this->RealizaPedido();
    }
    
    
    public function RealizaPedido(){
        $pedido = Array();
        echo '<pre>';
        print_r($this->myCarrito->get_content());
        echo '</pre>';
        
        $datos = $this->Mdl_pedidos->getDatosParaPedido($this->session->userdata('userid'));
        
        $pedido['idPedido'] = $this->getIdPedido();
        $pedido['idUsuario'] = $this->session->userdata('userid');
        $pedido['importe'] = $this->myCarrito->precio_total();
        $pedido['fecha_pedido'] = date("Y-m-j");
        $pedido['direccion'] = $datos['direccion'];
        $pedido['cp'] = $datos['cp'];
        $pedido['cod_provincia'] = $datos['cod_provincia'];
        $pedido['correo'] = $datos['correo'];
        
        $this->Mdl_pedidos->insertPedido($pedido);
        
        
        foreach($this->myCarrito->get_content() as $items){
            $linea_pedido = Array();
            $linea_pedido['idCamiseta'] = $items['id'];
            $linea_pedido['idPedido'] = $pedido['idPedido'];
            $linea_pedido['iva'] = $this->Mdl_pedidos->getIva($items['id'])['iva'];
            $linea_pedido['precio'] = $items['cantidad'];
          
            $this->Mdl_pedidos->insertLineaPedido($linea_pedido);
        }
    }
    //Función que crea un id para un pedido, sumándole uno al nº total de pedidos
    private function getIdPedido(){
        return $this->Mdl_pedidos->getCountPedidos() + 1;
    }
    private function MuestraResumen(){}

}
