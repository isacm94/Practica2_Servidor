<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class eliminarUsuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_usuarios');
    }

    public function index() {       
        
        $cuerpo = $this->load->view('View_eliminarUsuario', '', true); //Generamos la vista
        $this->load->view('View_plantilla', Array('titulo' => 'Eliminar Usuario', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
      
    }
    
    public function eliminar(){
        $this->Mdl_usuarios->setBajaUsuario($this->session->userdata('username'));//Damos de baja al usuario
        redirect(site_url()."Login/logout", 'Location', 301);//Cerramos su sesión
        
    }

}
