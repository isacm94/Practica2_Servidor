<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function index() {            
        $this->load->helper('url');  
        $this->load->library('form_validation');
        
        $this->load->model('Mdl_categorias'); //Cargamos modelo 
        $categorias = $this->Mdl_categorias->getCategorias(); //Conseguimos las categorías
        
        if(! $_POST){//Si no existe post, mostramos primera categoría
            $unaCategoria = $this->Mdl_categorias->getUnaCategoria($categorias[0]['idCategoria']); 
        }
        else{//Si no, se muestra la caategoría seleccionada
            $unaCategoria = $this->Mdl_categorias->getUnaCategoria($_POST['categoriaselect']); 
        }
        
        //Conseguimos las camisetas de la categoría seleccionada
        $camisetas = $this->Mdl_categorias->getCamisetasFromCategoria($unaCategoria[0]['idCategoria']);
        
        //Cargamos vista de las camisetas de la categoría seleccionada
        $htmlUnaCategoria = $this->load->view('View_unaCategoria', Array('unaCategoria' =>  $unaCategoria, 'camisetas' => $camisetas), true);
        
        $cuerpo = $this->load->view('View_categorias', Array('categoriaactive' => 'active', 'titulo' => $unaCategoria[0]['nombre_cat']." - ".$unaCategoria[0]['descripcion'], 'categorias' => $categorias, 'htmlUnaCategoria' => $htmlUnaCategoria ), true);
        
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo));
    }
}
