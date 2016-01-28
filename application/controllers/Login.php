<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $cuerpo = $this->load->view('View_login', '', true); //Generamos la vista       
        
        $this->load->view('View_plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        
    }
    
    public function IniciaSesion($username){
        $datos = array(
            'username' => $username,
            'logged_in' => TRUE
        );
        
        $this->session->set_userdata($datos);
    }
}
