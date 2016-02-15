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

        $xml = new SimpleXMLElement('<categorias/>'); //Crea el nodo principal <categorias>

        foreach ($categorias as $categoria) {
            $xml_cat = $xml->addChild('categoria'); //Crea etiqueta <categoria> dentro de <categorias>
            foreach ($categoria as $key => $value) {

                if ($key != 'idCategoria') {
                    $xml_cat->addChild($key, utf8_encode($value)); //Añade los datos de la categoria a <categoria>
                }
            }
            $this->XMLAddCamisetas($xml_cat, $categoria['idCategoria']); //Añade a <categoria> sus <camisetas>
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

    public function importar() {
        $cuerpo = $this->load->view('View_importarXML', Array('' => ''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Importar XML'));
    }

    public function ProcesaArchivo() {
//        echo '<pre>';
//        print_r($_FILES);
//        echo '</pre>';

        $archivo = $_FILES['archivo'];

        if (file_exists($archivo['tmp_name'])) {
            $xml = simplexml_load_file($archivo['tmp_name']);

            $this->InsertFromXML($xml);
                       
        } else {
            exit('Error abriendo el archivo XML');
        }
    }

    //Función que crea un array con los datos que lee desde el xml para insertarlos
    function InsertFromXML($xml) {

        foreach ($xml as $categoria) {
                        
            $cat['cod_categoria'] = (string) $categoria->cod_categoria;
            $cat['nombre_cat'] = (string) $categoria->nombre_cat;
            $cat['descripcion'] = (string) $categoria->descripcion;
            $cat['mostrar'] = (string) $categoria->mostrar;
            
            // Inserta categoria
            $categoria_id = $this->Mdl_xml->addCategoria($cat);

            foreach ($categoria->camisetas->camiseta as $camiseta) {

                $cam['cod_camiseta'] = (string) $camiseta->cod_camiseta;
                $cam['nombre_cam'] = (string) $camiseta->nombre_cam;
                $cam['precio'] = (string) $camiseta->precio;
                $cam['imagen'] = (string) $camiseta->imagen;
                $cam['iva'] = (string) $camiseta->iva;
                $cam['descripcion'] = (string) $camiseta->descripcion;
                $cam['seleccionada'] = (string) $camiseta->seleccionada;
                $cam['mostrar'] = (string) $camiseta->mostrar;
                $cam['fecha_inicio'] = (string) $camiseta->fecha_inicio;
                $cam['fecha_fin'] = (string) $camiseta->fecha_fin;
                $cam['stock'] = (string) $camiseta->stock;

                $cam['idCategoria'] = $categoria_id;
                // Inserta camiseta
                $this->Mdl_xml->AddCamiseta($cam);
                
            }
        }
    }

}
