<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra la información de una camiseta determinada.
 */
class PruebasUnitarias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {

        $pruebas[] = $this->unit->run($this->myCarrito->precio_total(), 'is_int', 'precio_total');

        $cuerpo = $this->load->view('View_PruebasUnitarias', Array('pruebas' => $pruebas), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Pruebas Unitarias del Carrito'));
    }

}
