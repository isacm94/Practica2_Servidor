<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_camiseta extends CI_Controller {

    public function index() {            
        $this->load->helper('url');  
        $this->load->library('form_validation');
        
        $this->load->model('Mdl_camiseta'); //Cargamos modelo 
        $camiseta = $this->Mdl_camiseta->getCamiseta('1'); //Conseguimos la camiseta a mostrar
        
        $categoria = $this->Mdl_camiseta->getCategoriaFromCamiseta($camiseta[0]['idCategoria']); //Conseguimos la categoría
                        
        $cuerpo = $this->load->view('View_camiseta', Array('camiseta' => $camiseta, 'categoria' => $categoria,
            'titulo' => $camiseta[0]['descripcion']), true);
             
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }
}

