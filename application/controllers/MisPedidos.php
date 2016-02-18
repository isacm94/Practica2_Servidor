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
        $this->load->helper('fechas_helper');
        $this->load->library('pagination');
    }

    public function index() {     
    }

    public function ver(/*$desde = 0*/) {
        //$config = $this->getConfigPag();        
        //$this->pagination->initialize($config);
        
        $pedidos = $this->Mdl_MisPedidos->getPedidos($this->session->userdata('userid'));
        $numPedidos = $this->Mdl_MisPedidos->getCountPedidos($this->session->userdata('userid'));
        
        if ($numPedidos == 0) {
            $cuerpo = $this->load->view('View_NoExistenPedidos', Array(), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
        
            return;
        } else if (!$pedidos) {
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

        if (!$pedidos) {
            redirect('Error404', 'Location', 301);
            return;
        }

        if ($estado == 'Pendiente') {
            $this->Mdl_MisPedidos->setAnulado($idPedido);
        } else if ($estado == 'Anulado') {
            $msg_error = '<div class="alert msgerror"> <b> ¡Error! </b> El pedido ya está anulado</div>';
        } else if ($estado == 'Procesado') {
            $msg_error = '<div class="alert msgerror"> <b> ¡Error! </b> El pedido ya está procesado, no se puede anular</div>';
        } else if ($estado == 'Recibido') {
            $msg_error = '<div class="alert msgerror"> <b> ¡Error! </b> El pedido ya ha sido recibido, no se puede anular</div>';
        } else {
            redirect('Error404', 'Location', 301);
        }

        $cuerpo = $this->load->view('View_MisPedidos', Array('pedidos' => $pedidos, 'msg_error' => $msg_error), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }
    
    public function getConfigPag(){
        //Configuración de Paginación
        $config['base_url'] = site_url('/MisPedidos/ver');
        $config['total_rows'] = $this->Mdl_MisPedidos->getCountPedidos($this->session->userdata('userid'));
        //$config['num_links'] = 6;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="pag_activa"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li title="Anterior">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li title="Siguiente">';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<li title="Inicio">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li title="Final">';
        $config['last_tag_close'] = '</li>';
    
        return $config;
    }
}
