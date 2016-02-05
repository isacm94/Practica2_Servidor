<?php

if (!defined('BASEPATH'))
    exit('No se permite el acceso directo al script');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        // Logo
        $this->Image('assets/img/favicon.png', 10, 8, 20, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Título
        $this->SetY(18);
        $this->SetX(35);
        $this->Cell(100, 0, utf8_decode('Pedido en Camisetas de Fútbol'), 0, 2);
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Cargar los datos
    function LoadData($file) {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

// Tabla simple
    function BasicTable($header, $data) {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

// Una tabla más completa
    function ImprovedTable($header, $data) {
        // Anchuras de las columnas
        $w = array(40, 35, 45, 40, 35);
        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Tabla coloreada
    function CreaTablaLineaPedidos($header, $data) {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Cabecera
        $w = array(40, 35, 45, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['idCamiseta'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['precio'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['iva'], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row['cantidad'], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row['importe'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
