<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra los pedidos del usuario pudiendo anularlo
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

    /**
     * Muestras todos los pedidos del usuario loagueado en forma de tabla
     */
    public function ver() {

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

    /**
     * Anula un pedido si se puede sino muestra un mensaje de error
     * @param Int $idPedido ID del pedido
     */
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
            $this->SubeStock($idPedido);
            redirect('/MisPedidos/ver', 301, 'Location');
            return;
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

    /**
     * Sube la cantidad de stock de las camisetas de un pedido después de anularlo
     * @param type $idPedido
     */
    public function SubeStock($idPedido) {
        $lineaPedidos = $this->Mdl_MisPedidos->getCantidad($idPedido);

        foreach ($lineaPedidos as $key => $value) {
            $this->Mdl_MisPedidos->CambiaStock($value['idCamiseta'], $value['cantidad']);
        }
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    public function getConfigPag() {
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
