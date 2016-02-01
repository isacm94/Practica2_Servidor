<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModificarCorrecto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {
    
        $cuerpo = $this->load->view('View_modCorrecto', array(''), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                'homeactive' => 'active'));
    }    
}
