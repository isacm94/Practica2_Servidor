<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que gestiona la exportación y la importación en XML
 */
class XML extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_xml');
    }

    /**
     * Crea y descarga un fichero XML con las categorías y las camisetas guardadas en la Base de Datos 
     */
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
        
        header('Content-Description: File Transfer');
        Header('Content-type: text/xml; charset=utf-8');
        Header('Content-type: octec/stream');
        Header('Content-disposition: filename="camisetasycategorias.xml"');
        print($xml->asXML());
    }

    /**
     * Crea la parte de las camisetas en XML
     * @param XML $xml_cat XML de la categoría correspondiente
     * @param Int $idCat ID de la categoría correspondiente
     */
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

    /**
     * Muestra el formulario donde tenemos que seleccionar el archivo XML para importar. 
     */
    public function importar() {
        $cuerpo = $this->load->view('View_importarXML', Array('' => ''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Importación en XML'));
    }

    /**
     * Importa los datos del archivo XML seleccionado. Este archivo debe tener el formato válido para importarlo
     */
    public function ProcesaArchivo() {

        $archivo = $_FILES['archivo'];

        if (file_exists($archivo['tmp_name'])) {
            $contentXML = utf8_encode(file_get_contents($archivo['tmp_name']));
            $xml = simplexml_load_string($contentXML);

            $this->InsertFromXML($xml);

            $cuerpo = $this->load->view('View_importacionXMLCorrecta', '', true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Importación en XML', 'homeactive' => 'active'));
        } else {
            exit('Error abriendo el archivo XML');
        }
    }
   
    /**
     * Crea un array con los datos que lee desde el XML para insertarlos en la Base de datos
     * @param XML $xml XML que estamos leyendo
     */
    function InsertFromXML($xml) {

        foreach ($xml as $categoria) {

            $cat['cod_categoria'] = (string) $categoria->cod_categoria;
            $cat['nombre_cat'] = (string) $categoria->nombre_cat;
            $cat['descripcion'] = (string) $categoria->descripcion;
            $cat['mostrar'] = (string) $categoria->mostrar;

            // Inserta categoria
            $categoria_id = $this->Mdl_xml->addCategoria($cat);//Guardamos su id para poder insertar las camisetas en esa categoría

            foreach ($categoria->camisetas->camiseta as $camiseta) {

                $cam['cod_camiseta'] = (string) $camiseta->cod_camiseta;
                $cam['nombre_cam'] = (string) $camiseta->nombre_cam;
                $cam['precio'] = (string) $camiseta->precio;
                $cam['imagen'] = (string) $camiseta->imagen;
                $cam['iva'] = (string) $camiseta->iva;
                $cam['descuento'] = (string) $camiseta->descuento;
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
