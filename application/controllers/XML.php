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
    public function exportar() {

        $categorias = $this->Mdl_xml->getCategorias();
        
        $xml = new SimpleXMLElement('<categorias/>');//Crea el nodo principal <categorias>

        foreach ($categorias as $categoria) {
            $xml_cat = $xml->addChild('categoria'); //Crea etiqueta <categoria> dentro de <categorias>
            foreach ($categoria as $key => $value) {

                if ($key != 'idCategoria') {
                    $xml_cat->addChild($key, utf8_encode($value)); //Añade los datos de la categoria a <categoria>
                }
            }
            $this->XMLAddCamisetas($xml_cat, $categoria['idCategoria']);//Añade a <categoria> sus <camisetas>
        }

        Header('Content-type: text/xml; charset=utf-8');
        Header('Content-type: octec/stream');
        Header('Content-disposition: filename="camisetasycategorias.xml"');
        print($xml->asXML());
    }

    protected function XMLAddCamisetas($xml_cat, $idCat) {
        $lista_camisetas = $this->Mdl_xml->getCamisetas($idCat);
        
        $xml_camisetas = $xml_cat->addChild('camisetas'); //Crea etiqueta <camisetas> dentro de <categoria>
        
        foreach ($lista_camisetas as $camiseta) {
            $xml_camiseta = $xml_camisetas->addChild('camiseta'); //Crea etiqueta <camiseta> dentro de <camisetas>

            foreach ($camiseta as $idx => $valor) {
                $xml_camiseta->addChild($idx, utf8_encode($valor)); //Añade a la etiqueta <camiseta>
            }           
        }
    }   

}
