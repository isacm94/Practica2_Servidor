<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra una vista cuando no se ha iniciado sesión en determinadas funciones como cuandono se ha iniciado sesión y se quiere finalizar la compra.
 */
class SesionNoIniciada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
    }

    /**
     * Muestra la vista de sesión no iniciada
     */
    public function index() {
        $cuerpo = $this->load->view('View_sesionNoIniciada', Array(), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Sesión no iniciada', 'carritoactive' => 'active'));
    }

}
