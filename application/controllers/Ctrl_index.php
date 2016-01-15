<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->helper('form');       
        
        //Carga vista cabecera
        $this->load->view('View_cabecera', Array('datos' => ''));
        
        //Carga vista cabecera
        $this->load->view('View_pie', Array('datos' => ''));       
    }
}
