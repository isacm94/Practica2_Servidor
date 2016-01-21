<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Mdl_categorias');
        $this->load->library('pagination');
    }

    public function index($desde = 0) {  
        $categorias = $this->Mdl_categorias->getCategorias(); //Conseguimos las categorías
        
        if(! $_POST){//Si no existe post, mostramos primera categoría
            $unaCategoria = $this->Mdl_categorias->getUnaCategoria($categorias[0]['idCategoria']); 
        }
        else{//Si no, se muestra la caategoría seleccionada
            $unaCategoria = $this->Mdl_categorias->getUnaCategoria($_POST['categoriaselect']); 
        }
        
        //Configuración de Paginación
        $config['base_url'] = site_url('/Categorias/index');
        $config['total_rows'] = $this->Mdl_categorias->getNumTotalCamisetasFromCategoria($unaCategoria[0]['idCategoria']);
        echo "<h1>".$config['total_rows']."</h1>";
        //$config['num_links'] = 1;
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;

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

        $this->pagination->initialize($config);
        
        //Conseguimos las camisetas de la categoría seleccionada
        $camisetas = $this->Mdl_categorias->getCamisetasFromCategoria($unaCategoria[0]['idCategoria'],  $config['per_page'], $desde);
        
        //Cargamos vista de las camisetas de la categoría seleccionada
        $htmlUnaCategoria = $this->load->view('View_unaCategoria', Array('unaCategoria' =>  $unaCategoria, 'camisetas' => $camisetas), true);
        
        $cuerpo = $this->load->view('View_categorias', Array('categoriaactive' => 'active', 'titulo' => $unaCategoria[0]['nombre_cat']." - ".$unaCategoria[0]['descripcion'], 'categorias' => $categorias, 'htmlUnaCategoria' => $htmlUnaCategoria ), true);
        
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo));
    }
}
