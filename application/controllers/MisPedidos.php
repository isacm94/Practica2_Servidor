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

    public function ver() {
        
        $pedidos = $this->Mdl_MisPedidos->getPedidos($this->session->userdata('userid'));
        
        if(! $pedidos){
            redirect("Error404", "Location", 301);
            return;
        }
        
        $cuerpo = $this->load->view('View_MisPedidos', Array('pedidos' => $pedidos), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }
    
    public function AnularPedido($idPedido) {
        $msg_error = '';
        $pedidos = $this->Mdl_MisPedidos->getPedidos($this->session->userdata('userid'));
        $estado = $this->Mdl_MisPedidos->getEstado($idPedido);
        
        if(! $pedidos){
            redirect('Error404', 'Location', 301);
            return;
        }           
       
        if($estado == 'Pendiente'){
            $this->Mdl_MisPedidos->setAnulado($idPedido);
        }
        else if($estado == 'Anulado'){
            $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b> El pedido ya está anulado</div>';
        }
        else if($estado == 'Procesado'){
            $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b> El pedido ya está procesado, no se puede anular</div>';
        }
        else if($estado == 'Recibido'){
            $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b> El pedido ya ha sido recibido, no se puede anular</div>';
        }  
        else{            
            redirect('Error404', 'Location', 301);
        }
        
        $cuerpo = $this->load->view('View_MisPedidos', Array('pedidos' => $pedidos, 'msg_error'=>$msg_error), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }

}
