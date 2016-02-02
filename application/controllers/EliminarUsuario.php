<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR al que accede un usuario si quiere eliminar su cuenta.
 * Sólo se podrá acceder a este controlador si se ha iniciado sesión.
 */
class EliminarUsuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_usuarios');
    }

    public function index() {
        if (SesionIniciadaCheck()) {
            $cuerpo = $this->load->view('View_eliminarUsuario', '', true); //Generamos la vista
            $this->load->view('View_plantilla', Array('titulo' => 'Eliminar Usuario', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        } else {
            redirect('Error404', 'location', 301);
        }
    }

    public function eliminar() {
        if (SesionIniciadaCheck()) {
            $this->Mdl_usuarios->setBajaUsuario($this->session->userdata('username')); //Damos de baja al usuario
            redirect(site_url() . "Login/logout", 'Location', 301); //Cerramos su sesión
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
