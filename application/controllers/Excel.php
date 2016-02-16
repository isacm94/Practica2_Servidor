<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_xml');
    }

    public function index() {
        $cuerpo = $this->load->view('View_importarExcel', Array('' => ''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Importación en Excel'));
    }

    public function ProcesaArchivo() {
        $archivo = $_FILES['archivo'];

        echo '<pre>';
        print_r($archivo);
        echo '</pre>';

        $objPHPExcel = PHPExcel_IOFactory::load($archivo['tmp_name']);

        foreach ($objPHPExcel->getWorksheetIterator() as $hojaEstilo) {
            $titulo = $hojaEstilo->getTitle();
            $num_filas = $hojaEstilo->getHighestRow(); // e.g. 10
            $maxColumna = $hojaEstilo->getHighestColumn(); // e.g 'F'
            $maxColumnaIndex = PHPExcel_Cell::columnIndexFromString($maxColumna);
            $num_columnas = ord($maxColumna) - 64;

            echo '<br>'.$titulo.' <table border="1"><tr>';
            for ($row = 1; $row <= $num_filas; ++$row) {
                echo '<tr>';
                for ($col = 0; $col < $maxColumnaIndex; ++$col) {
                    $cell = $hojaEstilo->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    echo '<td>' . $val . '<br></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }

}
