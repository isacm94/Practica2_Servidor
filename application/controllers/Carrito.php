<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function index() {            
        
    }
    
    public function comprar($id){
        $this->load->library('cart');
        $this->load->model('Mdl_carrito');
        $this->load->helper('Descuentos_helper');
        $this->load->helper('url');
        
        $camiseta = $this->Mdl_carrito->getDataCamiseta($id);
                
        $data = array(
            'id' => $camiseta[0]['idCamiseta'],
            'qty' => 1,
            'price' => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
            'name' => $camiseta[0]['descripcion']
        );
        $this->cart->insert($data);
        
        //echo print_r($this->cart->contents());
        $cuerpo = $this->load->view('View_carrito', '', true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito'));
    }
}

