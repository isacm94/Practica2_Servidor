<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra un mensaje cuando se ha realizado una modificación de usuario correcta.
 * Sólo se podrá acceder a este controlador si se ha iniciado sesión.
 */
class ModificarCorrecto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {
        if (!SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('View_modificarUserCorrecto', array(''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
            'homeactive' => 'active'));
    }

}
