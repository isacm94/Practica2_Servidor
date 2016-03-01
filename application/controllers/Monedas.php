<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que gestiona el cambio de monedas
 */
class Monedas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
    }
    /**
     * Cambia en la sesión la moneda
     * @param Float $rate Valor de la moneda
     * @param Float $currency Nombre de la moneda
     */
    public function Cambio($rate, $currency) {
        $datos = array(
            'rate' => $rate,
            'currency' => $currency
        );
        $this->session->set_userdata($datos);
        
        $url = $this->session->userdata('URL');
        redirect($url, 'location', 301); 
    }
}
