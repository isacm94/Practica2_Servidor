<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class XML extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_xml');
    }

    public function index() {}

    public function exportar() {
        Header('Content-type: text/xml');
        Header('Content-type: octec/stream');
        Header('Content-disposition: filename="camisetasycategorias.xml"');
        $this->GeneraXMLCamisetas();
        $this->GeneraXMLCategorias();
    }

    public function GeneraXMLCamisetas() {
        //Generación XML de camisetas
        $camisetas = $this->Mdl_xml->getCamisetas();

        $xmlcamiseta = new SimpleXMLElement('<camisetas/>');

        foreach ($camisetas as $camiseta) {
            $cam = $xmlcamiseta->addChild('camiseta');
            foreach ($camiseta as $key => $value) {
                $cam->addChild($key, $value);
            }
        }

        
        print($xmlcamiseta->asXML());
    }

    public function GeneraXMLCategorias() {

        $categorias = $this->Mdl_xml->getCategorias();

        $xmlcategoria = new SimpleXMLElement('<categorias/>');

        foreach ($categorias as $categoria) {
            $cat = $xmlcategoria->addChild('categoria');
            foreach ($categoria as $key => $value) {
                $cat->addChild($key, $value);
            }
        }

        //Header('Content-type: text/xml');
        //Header('Content-type: octec/stream');
        print($xmlcategoria->asXML());
    }

}
