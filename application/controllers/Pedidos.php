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
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->helper('Fechas');
    }

    public function index() {
        
    }

    public function RealizaPedido() {
        $pedido = Array();
        echo '<pre>';
        print_r($this->myCarrito->get_content());
        echo '</pre>';

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


        foreach ($this->myCarrito->get_content() as $items) {
            $linea_pedido = Array();
            $linea_pedido['idCamiseta'] = $items['id'];
            $linea_pedido['idPedido'] = $pedido['idPedido'];
            $linea_pedido['iva'] = $this->Mdl_pedidos->getIva($items['id'])['iva'];
            $linea_pedido['precio'] = $items['precio'];
            $linea_pedido['cantidad'] = $items['cantidad'];
            $linea_pedido['importe'] = $items['precio'] * $items['cantidad'];

            $this->Mdl_pedidos->insertLineaPedido($linea_pedido);
        }

        redirect('Pedidos/MuestraResumen/' . $pedido['idPedido'], 'Location', 301);
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

        //$this->CreaPDF_Pedido();
    }

    private function CreaPDF_Pedido() {

        $pdf = new FPDF();
        $pdf->AddPage();
    }

    private function EnviaCorreo($datos) {
        // Utilizando sendmail
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
        $this->email->to($datos['correo']);
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Restablece la contraseña en Camisetas de Fútbol');

        $mensaje = "Restablece la contraseña accediendo a la siguiente dirección: ";
        $mensaje.= site_url() . "/RestablecerContrasenha/Restablece/" . $datos['id'] . "/" . $this->getTonken($datos['id'], $datos['dni'], $datos['nombre']);
        $this->email->message($mensaje);

        if (!$this->email->send())
            echo "<pre>\n\nError ennviado mail\n</pre>";


        //echo $this->email->print_debugger();
    }

    //Función que crea un id para un pedido, sumándole uno al nº total de pedidos
    private function getIdPedido() {
        return $this->Mdl_pedidos->getCountPedidos() + 1;
    }

}
