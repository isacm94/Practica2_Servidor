<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR en el que se puede elegir la categoría a mostrar con las camisetas paginadas.
 */
class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Mdl_categorias');
        $this->load->library('Carro', 0, 'myCarrito');
    }

    /**
     * Muestra todas las camisetas de una categoría
     * @param Int $idCat ID de la categoría
     * @param Int $desde Posición de donde tiene que empezar a paginar
     */
    public function ver($idCat = 1, $desde = 0) {

        //Configuración de Paginación
        $config = $this->getConfigPag($idCat);

        $this->pagination->initialize($config);

        $unaCategoria = $this->Mdl_categorias->getUnaCategoria($idCat);

        $categorias = $this->Mdl_categorias->getCategorias();

        //Conseguimos las camisetas de la categoría seleccionada
        $camisetas = $this->Mdl_categorias->getCamisetasFromCategoria($idCat, $config['per_page'], $desde);

        //Cargamos vista de las camisetas de la categoría seleccionada
        $htmlUnaCategoria = $this->load->view('View_unaCategoria', Array('unaCategoria' => $unaCategoria, 'camisetas' => $camisetas), true);

        $cuerpo = $this->load->view('View_categorias', Array('categoriaactive' => 'active', 'titulo' => $unaCategoria['descripcion'], 'categorias' => $categorias, 'htmlUnaCategoria' => $htmlUnaCategoria), true);

        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo));
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @param Int $idCat ID de la categoría
     * @return Array Configuración
     */
    function getConfigPag($idCat) {
        $config['base_url'] = site_url('/Categorias/ver/' . $idCat . '/');
        $config['total_rows'] = $this->Mdl_categorias->getNumTotalCamisetasFromCategoria($idCat);
        //$config['num_links'] = 1;
        $config['per_page'] = $this->config->item('per_page_categorias');
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="pag_activa"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li title="Anterior">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li title="Siguiente">';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<li title="Inicio">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li title="Final">';
        $config['last_tag_close'] = '</li>';

        return $config;
    }

}
