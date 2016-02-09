<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR en el que se lleva a cabo todo lo relacionado con la compra de productos.
 * (Añadir y eliminar camisetas, actualizar y vacíar carrito).
 * Sólo se podrá acceder a este controlador si se ha iniciado sesión.
 */
class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('Descuentos_helper');
        $this->load->model('Mdl_carrito');
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {

        if (SesionIniciadaCheck()) {

            $msg_error = "";
            $data = array();

            //Borra los mensajes de error
            $this->BorrarMensajesError();

            //BOTÓN GUARDAR CAMBIOS
            if (isset($_POST['guardar'])) {

                //Si existen artículos guardados
                if ($this->myCarrito->articulos_total() > 0) {

                    foreach ($this->myCarrito->get_content() as $items) :
                        $stock = $this->Mdl_carrito->getStock($items['id'])[0]['stock']; //Guardamos su stock

                        if ($stock >= $_POST["cantidad"][$items['id']]) {//Si existe stock disponible para la venta, se actualiza el carrito
                            $articulo = array(
                                "id" => $items['id'],
                                "cantidad" => $_POST["cantidad"][$items['id']],
                                "precio" => $items['precio'],
                                "nombre" => $items['nombre'],
                                'opciones' => array('imagen' => $items['opciones']['imagen'], 'error' => '')
                            );
                            $this->myCarrito->actualizar($articulo);
                        } else if ($stock < $_POST["cantidad"][$items['id']]) {//sino mostramos mensaje de error
                            $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b>Stock máximo superado</div>';

                            $articulo = array(
                                "id" => $items['id'],
                                "cantidad" => $items['cantidad'],
                                "precio" => $items['precio'],
                                "nombre" => $items['nombre'],
                                'opciones' => array('imagen' => $items['opciones']['imagen'],
                                    'error' => '<div class="iconoerror"><span class="glyphicon glyphicon-warning-sign"></span></div>')
                            );


                            $this->myCarrito->actualizar($articulo);
                        }
                    endforeach;
                }
            }
            $cuerpo = $this->load->view('View_carrito', Array('msg_error' => $msg_error), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

    public function eliminar($id) {

        if (SesionIniciadaCheck()) {
            foreach ($this->myCarrito->get_content() as $items) {

                if ($items['id'] == $id) {
                    $this->myCarrito->remove_producto($items['unique_id']);
                }
            }

            redirect('Carrito', 'location', 301);
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

    public function comprar($id) {
        if (SesionIniciadaCheck()) {
            $camiseta = $this->Mdl_carrito->getDataCamiseta($id);
            $stock = $this->Mdl_carrito->getStock($id)[0]['stock']; //Guardamos su stock

            foreach ($this->myCarrito->get_content() as $items) {
                if ($items['id'] == $id) {
                    $cantidad = $items['cantidad'];
                }
            }

            if ($this->input->post('cantidadCam')) { //Si se ha introducido alguna cantidad en la vista de una camiseta
                $cantidadIntroducida = $this->input->post('cantidadCam');
            } else {
                $cantidadIntroducida = 1;
            }

            if ($stock >= ($cantidad + $cantidadIntroducida)) {
                $articulo = array(
                    "id" => $camiseta[0]['idCamiseta'],
                    "cantidad" => $cantidadIntroducida,
                    "precio" => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
                    "nombre" => $camiseta[0]['descripcion'],
                    "opciones" => array('imagen' => $camiseta[0]['imagen'], 'error' => '')
                );

                $this->myCarrito->add($articulo);
                redirect('Carrito', 'location', 301);
            } else if ($stock < ($cantidad + $cantidadIntroducida)) {

                $articulo = array(
                    "id" => $camiseta[0]['idCamiseta'],
                    "cantidad" => $cantidad,
                    "precio" => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
                    "nombre" => $camiseta[0]['descripcion'],
                    'opciones' => array('imagen' => $camiseta[0]['imagen'],
                        'error' => '<div class="iconoerror"><span class="glyphicon glyphicon-warning-sign"></span></div>')
                );


                $this->myCarrito->actualizar($articulo);

                $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b>Stock máximo superado</div>';
                $cuerpo = $this->load->view('View_carrito', Array('msg_error' => $msg_error), true);
                $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
            }
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

    //Elimina todo el carrito
    public function eliminarcompra() {
        if (SesionIniciadaCheck()) {
            $this->myCarrito->destroy();

            redirect('', 'location', 301); //Vuelve a la página principal
        } else {
            redirect('SesionNoIniciada', 'Location', 301);
        }
    }

    public function BorrarMensajesError() {
        if ($this->myCarrito->articulos_total() > 0) :
            foreach ($this->myCarrito->get_content() as $items) {
                $articulo = array(
                    "id" => $items['id'],
                    "cantidad" => $items['cantidad'],
                    "precio" => $items['precio'],
                    "nombre" =>
                    $items['nombre'],
                    'opciones' => array('imagen' => $items['opciones']['imagen'], 'error' => '')
                );
                $this->myCarrito->actualizar($articulo);
            }
        endif;
    }

}
