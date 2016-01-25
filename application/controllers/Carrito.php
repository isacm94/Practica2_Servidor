<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('Carrito');
        $this->load->helper('url');
        $this->load->helper('Descuentos_helper');
        $this->load->library('cart');
        $this->load->model('Mdl_carrito');
    }

    public function index() {
        $msg_error = "";
        $data = array();
        //Borra los mensajes de error
        foreach ($this->cart->contents() as $items) {
            $data[$items['rowid']] = array(
                'rowid' => $items['rowid'],
                'options' => array('imagen' => $items['options']['imagen'], 'error' => '')
            );
        }
                
        $this->cart->update($data);       
        
        //BOTÓN GUARDAR CAMBIOS
        if (isset($_POST['guardar'])) {

            foreach ($this->cart->contents() as $items) {
                $stock = $this->Mdl_carrito->getStock($items['id'])[0]['stock'];

                if ($stock >= $_POST["cantidad"][$items['id']]) {

                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => $_POST["cantidad"][$items['id']],
                        'options' => array('imagen' => $items['options']['imagen'], 'error' => '')
                    );

                    $this->cart->update($data);
                } else if ($stock < $_POST["cantidad"][$items['id']]){
                  
                    $msg_error = '<div class="alert alert-danger" style="background-color: red; color: white;"> <b> ¡Error! </b>Stock máximo superado</div>';

                    $data = array(
                        'rowid' => $items['rowid'],
                        'options' => array('imagen' => $items['options']['imagen'], 'error' => '<div class="iconoerror"><span class="glyphicon glyphicon-warning-sign"></span></div>')
                    );
                    $this->cart->update($data);
                }
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

        $data = array(
            'id' => $camiseta[0]['idCamiseta'],
            'qty' => 1,
            'price' => getPrecioFinal($camiseta[0]['precio'], $camiseta[0]['descuento']),
            'name' => $camiseta[0]['descripcion'],
            'options' => array('imagen' => $camiseta[0]['imagen'], 'error' => '')
        );

        if (!$this->cart->insert($data)) {
            echo 'Falla carrito';
        }

        redirect('Carrito', 'location', 301);

//        $cuerpo = $this->load->view('View_carrito', '', true);
//        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Carrito', 'carritoactive' => 'active'));
    }

}
