<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra una vista cuando no se ha iniciado sesión en determinadas funciones como en el carrito.
 */
class SesionNoIniciada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {
        $cuerpo = $this->load->view('View_sesionNoIniciada', Array(), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Sesión no iniciada', 'carritoactive' => 'active'));
    }

}
