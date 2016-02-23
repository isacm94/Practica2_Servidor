<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que realiza un pedido
 */
class Pedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_pedidos');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_mail');
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->library('email');
        $this->load->helper('fechas_helper');
    }

    /**
     * Guarda el pedido en la base de datos con los productos que se han comprado a tráves del carrito
     */
    public function RealizaPedido() {

        if (SesionIniciadaCheck()) {
            $pedido = Array();

            $datos = $this->Mdl_pedidos->getDatosParaPedido($this->session->userdata('userid'));

            $pedido['idUsuario'] = $this->session->userdata('userid');
            $pedido['importe'] = $this->myCarrito->precio_total();
            $pedido['cantidad_total'] = $this->myCarrito->articulos_total();
            $pedido['fecha_pedido'] = date("Y-m-j");
            $pedido['direccion'] = $datos['direccion'];
            $pedido['cp'] = $datos['cp'];
            $pedido['cod_provincia'] = $datos['cod_provincia'];
            $pedido['correo'] = $datos['correo'];

            $idPedido = $this->Mdl_pedidos->insertPedido($pedido);

            $lineas_pedidos = Array();
            
            foreach ($this->myCarrito->get_content() as $items) {
                $linea_pedido = Array();
                $linea_pedido['idCamiseta'] = $items['id'];
                $linea_pedido['idPedido'] = $idPedido;
                $linea_pedido['iva'] = $this->Mdl_pedidos->getIva($items['id'])['iva'];
                $linea_pedido['precio'] = $items['precio'];
                $linea_pedido['cantidad'] = $items['cantidad'];
                $linea_pedido['importe'] = $items['precio'] * $items['cantidad'];

                $this->Mdl_pedidos->insertLineaPedido($linea_pedido);
                $lineas_pedidos[] = $linea_pedido;
            }

            $datos = $this->Mdl_mail->getDatosFromUsername($this->session->userdata('username'));

            $this->EnviaCorreo($datos['correo'], $idPedido);

            $this->myCarrito->destroy(); //Vacíamos carrito
            redirect('Pedidos/MuestraResumen/' . $idPedido, 'Location', 301);
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

    /**
     * Muestra un resumen de un pedido determinado
     * @param Int $idPedido ID del pedido
     */
    public function MuestraResumen($idPedido) {

        $pedido = $this->Mdl_pedidos->getPedido($idPedido, $this->session->userdata('userid'));

        if (!$pedido) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $datosenvio = $this->Mdl_pedidos->getDatosEnvio($idPedido);
        $datosenvio['provincia'] = $this->Mdl_provincias->getNombreProvincia($datosenvio['cod_provincia']);

        $lineaspedidos = $this->Mdl_pedidos->getLineasPedidos($idPedido);

        $cuerpo = $this->load->view('View_resumenPedido', Array('pedido' => $pedido, 'datosenvio' => $datosenvio, 'lineaspedidos' => $lineaspedidos), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Resumen del pedido', 'homeactive' => 'active'));
    }

    /**
     * Crea un PDF de un pedido determinado con todos los datos del pedido y los productos comprados
     * @param Int $idPedido ID del pedido
     * @param Char $metodo I --> envía el fichero al navegador / D --> Fuerza la descarga
     */
    private function CreaPDF_Pedido($idPedido, $metodo = 'F') {
        $this->load->library('PDF', 0, 'myPDF');

        $this->myPDF->AddPage();
        $this->myPDF->AliasNbPages(); //nº de páginas
        $this->myPDF->SetFont('Arial', '', 10);

        //DATOS que ponemos al principio de la factura
        $datos = $this->Mdl_pedidos->getDatosParaPDF($this->session->userdata('userid'));

        $this->myPDF->Cell(0, 7, utf8_decode($datos['nombre_persona'] . ', ' . $datos['apellidos_persona']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode("DNI: " . $datos['dni']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode($datos['direccion'] . ', ' . $datos['cp'] . ' (' . $datos['provincia'] . ')'), 0, 1);

        //TABLA LÍNEA DE PEDIDOS
        $lineas_pedidos = $this->Mdl_pedidos->getLineasPedidos($idPedido);
        foreach ($lineas_pedidos as $linea) {
            $data[] = $linea;
        }

        $this->myPDF->CreaTablaLineaPedidos($data);

        //TABLA PEDIDO
        $pedido = $this->Mdl_pedidos->getPedido($idPedido, $this->session->userdata('userid'));
        $this->myPDF->CreaTablaPedido($pedido);

        $this->myPDF->Output($metodo, 'assets/pdfs_pedidos/pedido.pdf', true);
    }

    /**
     * Envia un correo con el PDF del pedido
     * @param String $correo Dirección de mail donde se tiene que mandar el correo
     * @param Int $idPedido ID del pedido
     */
    public function EnviaCorreo($correo, $idPedido) {

        $this->CreaPDF_Pedido($idPedido);
        
        $this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
        
        $this->email->to($correo);

        $this->email->subject('El PDF con su pedido');

        $mensaje = "Aquí puede ver el documento PDF de su pedido";

        $this->email->message($mensaje);

        $this->email->attach('assets/pdfs_pedidos/pedido.pdf');

        if (!$this->email->send())
            echo "<pre>\n\nError ennviado mail\n</pre>";
    }

    /**
     * Muestra un pedido en el navegador
     * @param Int $idPedido ID del pedido
     */
    public function VerPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'I');
    }

    /**
     * Descarga un pedido en la carpeta 'Descargas'
     * @param Int $idPedido ID del pedido
     */
    public function DescargarPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'D');
    }
}
