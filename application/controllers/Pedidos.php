<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Pedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_pedidos');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_mail');
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->library('email');
        $this->load->helper('Fechas');
    }

    public function index() {
        
    }

    public function RealizaPedido() {

        if (SesionIniciadaCheck()) {
            $pedido = Array();

            $datos = $this->Mdl_pedidos->getDatosParaPedido($this->session->userdata('userid'));

            $pedido['idPedido'] = $this->getIdPedido();
            $pedido['idUsuario'] = $this->session->userdata('userid');
            $pedido['importe'] = $this->myCarrito->precio_total();
            $pedido['cantidad_total'] = $this->myCarrito->articulos_total();
            $pedido['fecha_pedido'] = date("Y-m-j");
            $pedido['direccion'] = $datos['direccion'];
            $pedido['cp'] = $datos['cp'];
            $pedido['cod_provincia'] = $datos['cod_provincia'];
            $pedido['correo'] = $datos['correo'];

            $this->Mdl_pedidos->insertPedido($pedido);

            $lineas_pedidos = Array();
            foreach ($this->myCarrito->get_content() as $items) {
                $linea_pedido = Array();
                $linea_pedido['idCamiseta'] = $items['id'];
                $linea_pedido['idPedido'] = $pedido['idPedido'];
                $linea_pedido['iva'] = $this->Mdl_pedidos->getIva($items['id'])['iva'];
                $linea_pedido['precio'] = $items['precio'];
                $linea_pedido['cantidad'] = $items['cantidad'];
                $linea_pedido['importe'] = $items['precio'] * $items['cantidad'];

                $this->Mdl_pedidos->insertLineaPedido($linea_pedido);
                $lineas_pedidos[] = $linea_pedido;
            }


            $datos = $this->Mdl_mail->getDatosFromUsername($this->session->userdata('username'));

            $this->EnviaCorreo($datos, $pedido['idPedido']);

            $this->myCarrito->destroy(); //Vacíamos carrito
            redirect('Pedidos/MuestraResumen/' . $pedido['idPedido'], 'Location', 301);
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

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

    public function EnviaCorreo($datos, $idPedido) {

        $this->CreaPDF_Pedido($idPedido);

        // Utilizando sendmail
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
        echo $datos['correo'];
        $this->email->to($datos['correo']);
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('El PDF con su pedido');

        $mensaje = "Aquí puede ver el documento PDF de su pedido";

        $this->email->message($mensaje);

        $this->email->attach('assets/pdfs_pedidos/pedido.pdf');

        if (!$this->email->send())
            echo "<pre>\n\nError ennviado mail\n</pre>";


        //echo $this->email->print_debugger();
    }

    public function VerPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'I');
    }

    public function DescargarPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'D');
    }

    //Función que crea un id para un pedido, sumándole uno al nº total de pedidos
    private function getIdPedido() {
        return $this->Mdl_pedidos->getCountPedidos() + 1;
    }

}
