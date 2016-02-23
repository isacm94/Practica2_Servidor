<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra la información de una camiseta determinada.
 */
class Camiseta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('descuentos_helper');
        $this->load->model('Mdl_camiseta'); //Cargamos modelo de camiseta
        $this->load->library('Carro', 0, 'myCarrito');
    }

    
    /**
     * Muestra la camiseta de forma detallada
     * @param Int $idCamiseta ID de la camiseta
     */
    public function ver($idCamiseta) {

        //Información de camiseta
        if ($this->Mdl_camiseta->SiSeDebeMostarCamiseta($idCamiseta)) {

            $camiseta = $this->Mdl_camiseta->getCamiseta($idCamiseta); //Conseguimos la camiseta a mostrar

            $categoria = $this->Mdl_camiseta->getInfoCategoriaFromCamiseta($camiseta['idCategoria']); //Conseguimos la categoría

            $camRelacionadas = $this->Mdl_camiseta->getCamisetasRelacionadasFromCategoria($camiseta['idCategoria'], $camiseta['idCamiseta']); //Camisetas relacionadas

            $cuerpo = $this->load->view('View_camiseta', Array('camiseta' => $camiseta, 'categoria' => $categoria,
                'titulo' => $camiseta['descripcion'], 'camRelacionadas' => $camRelacionadas), true);

            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active'));
        } else {
            $cuerpo = $this->load->view('View_error404', Array('' => ''), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
        }
    }

}
