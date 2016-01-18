<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function index() {
        $this->load->helper('url');  
        
        $this->load->model('Mdl_seleccionadas'); //Cargamos modelo 
        $seleccionadas = $this->Mdl_seleccionadas->getSeleccionadas(); //Conseguimos los artículos seleccionados
                
        $cuerpo  = $this->load->view('View_seleccionadas', Array('seleccionadas' => $seleccionadas), true); //Generamos la vista       
        
        //Pasamos a la plantilla la vista generada
        $this->load->view('View_plantilla', Array('titulo' => 'Camisetas de Fútbol destacadas', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }
}
