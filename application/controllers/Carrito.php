<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('Carrito');
        $this->load->helper('url');
        $this->load->helper('Descuentos_helper');
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_carrito');
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
                $this->myCarrito->add($articulo);
            }
        endif;

        //BOTÓN GUARDAR CAMBIOS
        if (isset($_POST['guardar'])) {

            if ($this->myCarrito->articulos_total() > 0) {
                foreach ($this->myCarrito->get_content() as $items) :
                    $stock = $this->Mdl_carrito->getStock($items['id'])[0]['stock'];

                    if ($stock >= $_POST["cantidad"][$items['id']]) {
                        $articulo = array(
                            "id" => $items['id'],
                            "cantidad" => $_POST["cantidad"][$items['id']],
                            "precio" => $items['precio'],
                            "nombre" => $items['nombre'],
                            'opciones' => array('imagen' => $items['opciones']['imagen'], 'error' => '')
                        );
                        $this->myCarrito->add($articulo);
                    } else if ($stock < $_POST["cantidad"][$items['id']]) {

                        $msg_error = '<div class="alert alert-danger msgerror"> <b> ¡Error! </b>Stock máximo superado</div>';

                        $articulo = array(
                            "id" => $items['id'],
                            "cantidad" => $items['cantidad'],
                            "precio" => $items['precio'],
                            "nombre" => $items['nombre'],
                            'opciones' => array('imagen' => $items['opciones']['imagen'], 
                                                'error' => '<div class="iconoerror"><span class="glyphicon glyphicon-warning-sign"></span></div>')
                        );


                        $this->myCarrito->add($articulo);
                    }
                endforeach;


                
            }
        }
        $cuerpo = $this->load->view('View_carrito', Array('msg_error' => $msg_error), true);
                $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }

    public function eliminar($id) {

        foreach ($this->cart->contents() as $items) {

            if ($items['id'] == $id) {
                $data['rowid'] = $items['rowid'];
                $data['qty'] = 0;
            }
        }
        $this->cart->update($data);

        redirect('Carrito', 'location', 301);
//        $cuerpo = $this->load->view('View_carrito', '', true);
//        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }

    public function comprar($id) {
        $camiseta = $this->Mdl_carrito->getDataCamiseta($id);

        $articulo = array(
            "id" => $camiseta[0]['idCamiseta'],
            "cantidad" => +1,
            "precio" => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
            "nombre" => $camiseta[0]['descripcion'],
            "opciones" => array('imagen' => $camiseta[0]['imagen'], 'error' => '')
        );

//log_message('debug', "Comprar-CARRITO\n".print_r($this->myCarrito,true));
        $this->myCarrito->add($articulo);

//        echo '<pre>';
//        print_r($this->myCarrito->get_content());
//        echo '</pre>';
//
//        $data = array(
//            'id' => $camiseta[0]['idCamiseta'],
//            'qty' => 1,
//            'price' => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
//            'name' => $camiseta[0]['descripcion'],
//            'options' => array('imagen' => $camiseta[0]['imagen'], 'error' => '')
//        );
//
//        if (!$this->cart->insert($data)) {
//            echo 'Falla carrito';
//        }

        redirect('Carrito', 'location', 301);

//$cuerpo = $this->load->view('View_carrito', '', true);
//$this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }

}
