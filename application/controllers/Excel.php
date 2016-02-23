<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que procesa un archivo cargado y lo importa en la base de datos.
 */
class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_xml');
    }

    /**
     * Muestra la vista donde podemos cargar el archivo excel
     */
    public function index() {
        $cuerpo = $this->load->view('View_importarExcel', Array('' => ''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Importación en Excel'));
    }

    /**
     * Lee el archivo excel cargado y lo importa en la base de datos
     */
    public function ProcesaArchivo() {
        $archivo = $_FILES['archivo'];

        $objPHPExcel = PHPExcel_IOFactory::load($archivo['tmp_name']);

        foreach ($objPHPExcel->getWorksheetIterator() as $hojaEstilo) {
            $num_filas = $hojaEstilo->getHighestRow();
            
            $cell = $hojaEstilo->getCellByColumnAndRow(0, 3);
            $categoria['cod_categoria'] = $cell->getValue();

            $cell = $hojaEstilo->getCellByColumnAndRow(1, 3);
            $categoria['nombre_cat'] = $cell->getValue();

            $cell = $hojaEstilo->getCellByColumnAndRow(2, 3);
            $categoria['descripcion'] = $cell->getValue();

            $cell = $hojaEstilo->getCellByColumnAndRow(3, 3);
            $categoria['mostrar'] = $cell->getValue();

            $categoria_id = $this->Mdl_xml->addCategoria($categoria); //Guardamos su id para poder insertar las camisetas en esa categoría
           
            //CREA e INSERTA CAMISETA DESDE EXCEL
            for ($row = 7; $row <= $num_filas; ++$row) {

                for ($col = 0; $col <= 11; ++$col) {

                    switch ($col) {

                        case 0:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['cod_camiseta'] = $cell->getValue();
                            break;
                        case 1:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['nombre_cam'] = $cell->getValue();
                            break;
                        case 2:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['precio'] = $cell->getValue();
                            break;
                        case 3:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['descuento'] = $cell->getValue();
                            break;
                        case 4:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['imagen'] = $cell->getValue();
                            break;
                        case 5:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['iva'] = $cell->getValue();
                            break;
                        case 6:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['descripcion'] = $cell->getValue();
                            break;
                        case 7:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['seleccionada'] = $cell->getValue();
                            break;
                        case 8:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['mostrar'] = $cell->getValue();
                            break;
                        case 9:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            $camiseta['fecha_inicio'] = PHPExcel_Style_NumberFormat::toFormattedString($val, 'YYYY-MM-DD');
                            break;
                        case 10:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            $camiseta['fecha_fin'] = PHPExcel_Style_NumberFormat::toFormattedString($val, 'YYYY-MM-DD');
                            break;
                        case 11:
                            $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                            $camiseta['stock'] = $cell->getValue();
                            break;
                    }
                }
                $camiseta['idCategoria'] = $categoria_id;//Guardamos el id de su categoría
                
                $this->Mdl_xml->AddCamiseta($camiseta);// Inserta camiseta
            }
        }

        $cuerpo = $this->load->view('View_importacionExcelCorrecta', '', true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Importación en Excel', 'homeactive' => 'active'));
    }

}

