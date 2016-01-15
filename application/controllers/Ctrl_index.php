<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->helper('form');       
        
        $this->load->model('Mdl_seleccionadas'); //Cargamos modelo 
        $seleccionadas = $this->Mdl_seleccionadas->getSeleccionadas();
                
        $html  = $this->load->view('View_seleccionadas', Array('seleccionadas' => $seleccionadas), true);
        
        
        //Carga vista cabecera
        $this->load->view('View_plantilla', Array('titulo' => 'Camisetas de Fútbol', 'cuerpo' => $html));
    }
}
