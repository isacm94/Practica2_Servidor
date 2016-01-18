<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_camiseta extends CI_Controller {

    public function index() {
        
    }

    //Ver camiseta detallada
    public function Ver($idCamiseta) {
        $this->load->helper('url');
        $this->load->helper('Descuentos');

        $this->load->model('Mdl_camiseta'); //Cargamos modelo

        if ($this->Mdl_camiseta->SiSeDebeMostarCamiseta($idCamiseta)) {

            $camiseta = $this->Mdl_camiseta->getCamiseta($idCamiseta); //Conseguimos la camiseta a mostrar

            $categoria = $this->Mdl_camiseta->getCategoriaFromCamiseta($camiseta[0]['idCategoria']); //Conseguimos la categoría

            $cuerpo = $this->load->view('View_camiseta', Array('camiseta' => $camiseta, 'categoria' => $categoria,
                'titulo' => $camiseta[0]['descripcion']), true);   
            
                    $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active'));
           
        }
        else{
            $cuerpo = $this->load->view('View_error404', Array('' => ''), true); 
                    $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
        }
        

    }

}
