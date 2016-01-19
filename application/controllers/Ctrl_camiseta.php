<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_camiseta extends CI_Controller {

    public function index() {
        
    }

    //Ver camiseta detallada
    public function Ver($idCamiseta) {
        $this->load->helper('url');
        $this->load->helper('Descuentos');
        $this->load->model('Mdl_camiseta'); //Cargamos modelo de camiseta
        
        //Información de camiseta
        if ($this->Mdl_camiseta->SiSeDebeMostarCamiseta($idCamiseta)) {

            $camiseta = $this->Mdl_camiseta->getCamiseta($idCamiseta); //Conseguimos la camiseta a mostrar
            
            $categoria = $this->Mdl_camiseta->getInfoCategoriaFromCamiseta($camiseta[0]['idCategoria']); //Conseguimos la categoría

            $camRelacionadas = $this->Mdl_camiseta->getCamisetasRelacionadasFromCategoria($camiseta[0]['idCategoria'], $camiseta[0]['idCamiseta']); //Camisetas relacionadas

            $cuerpo = $this->load->view('View_camiseta', Array('camiseta' => $camiseta, 'categoria' => $categoria,
                'titulo' => $camiseta[0]['descripcion'], 'camRelacionadas' => $camRelacionadas), true);

            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active'));
        } else {
            $cuerpo = $this->load->view('View_error404', Array('' => ''), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
        }
    }

}
