<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('Carrito');
        $this->load->helper('Descuentos_helper');
        $this->load->model('Mdl_carrito');
        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {
        $msg_error = "";
        $data = array();

        //Borra los mensajes de error
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
    }

    public function eliminar($id) {

        foreach ($this->myCarrito->get_content() as $items) {

            if ($items['id'] == $id) {
                $this->myCarrito->remove_producto($items['unique_id']);
            }
        }

        redirect('Carrito', 'location', 301);
    }

    public function comprar($id) {
        $camiseta = $this->Mdl_carrito->getDataCamiseta($id);
        $stock = $this->Mdl_carrito->getStock($id)[0]['stock']; //Guardamos su stock

        foreach ($this->myCarrito->get_content() as $items) {
            if ($items['id'] == $id) {
                $cantidad = $items['cantidad'];
            }
        }

        if ($stock > $cantidad) {
            $articulo = array(
                "id" => $camiseta[0]['idCamiseta'],
                "cantidad" => +1,
                "precio" => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
                "nombre" => $camiseta[0]['descripcion'],
                "opciones" => array('imagen' => $camiseta[0]['imagen'], 'error' => '')
            );

            $this->myCarrito->add($articulo);
            redirect('Carrito', 'location', 301);
            
        } else if ($stock <= $cantidad) {
            $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b>Stock máximo superado</div>';
            $cuerpo = $this->load->view('View_carrito', Array('msg_error' => $msg_error), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
        }
    }

    //Elimina todo el carrito
    public function eliminarcompra() {
        $this->myCarrito->destroy();

        redirect('', 'location', 301); //Vuelve a la página principal
    }

}
