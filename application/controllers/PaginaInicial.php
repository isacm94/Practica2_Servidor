<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PaginaInicial extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->helper('Descuentos');

        $this->load->model('Mdl_seleccionadas'); //Cargamos modelo 
        
        //Paginación
        $this->load->library('pagination');
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url();
        $config['total_rows'] = $this->Mdl_seleccionadas->getNumTotalCamisetas();
        //$config['num_links'] = 6;
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="pag_activa"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        
        $seleccionadas = $this->Mdl_seleccionadas->getSeleccionadas($config['per_page'], $desde); //Conseguimos los artículos seleccionados
        	     

        $cuerpo = $this->load->view('View_seleccionadas', Array('seleccionadas' => $seleccionadas), true); //Generamos la vista       
        //Pasamos a la plantilla la vista generada
        $this->load->view('View_plantilla', Array('titulo' => 'Camisetas de Fútbol destacadas', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }
    
}
