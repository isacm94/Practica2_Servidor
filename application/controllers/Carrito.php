<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('Carrito');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->helper('Descuentos_helper');
    }
    public function index() {
        $cuerpo = $this->load->view('View_carrito', '', true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }
    
    public function comprar($id){        
        $this->load->model('Mdl_carrito');           
        
        $camiseta = $this->Mdl_carrito->getDataCamiseta($id);
                
        $data = array(
            'id' => $camiseta[0]['idCamiseta'],
            'qty' => 1,
            'price' => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
            'name' => $camiseta[0]['descripcion'],
            'options' => array('imagen' => $camiseta[0]['imagen'])
        );
        
        if (! $this->cart->insert($data)) {
            echo 'Falla carrito';
        }
        
                
        $cuerpo = $this->load->view('View_carrito', '', true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }
}

