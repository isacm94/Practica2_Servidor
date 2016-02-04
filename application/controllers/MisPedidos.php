<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class MisPedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_MisPedidos');
        $this->load->model('Mdl_provincias');
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->helper('Fechas');
    }

    public function index() {
        
    }

    public function ver($id) {
        
        $pedidos = $this->Mdl_MisPedidos->getPedido($id);
        
        if(! $pedidos || $id != $this->session->userdata('userid')){
            redirect("Error404", "Location", 301);
            return;
        }
        
        $cuerpo = $this->load->view('View_MisPedidos', Array('pedidos' => $pedidos), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }

}
