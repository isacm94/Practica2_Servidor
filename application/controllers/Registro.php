<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->helper('url');
        $this->load->helper('CreaSelect');
        $this->load->library('form_validation');
        $this->load->model('Mdl_provincias');
    }

    public function index() {
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelect($provincias, 'cod_provincia');

        $cuerpo = $this->load->view('View_registro', array('select' => $select), true);

        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario', 'homeactive' => 'active'));
    }

    public function Usuario() {
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelect($provincias, 'cod_provincia');
                
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger msgerror"><b>¡Error! </b>','</div>');
        
        //Establecemos los mensajes de errores
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('email_valid', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('alpha', 'El campo %s no puede contener números');
        
        //Establecemos reglas de validación para el formulario
        $this->form_validation->set_rules('nombre_usu', 'nombre de usuario', 'required');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('rep_clave', 'repita contraseña', 'required');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|email_valid');
        $this->form_validation->set_rules('nombre_persona', 'nombre', 'required|alpha');
        $this->form_validation->set_rules('apellidos_persona', 'apellidos', 'required|alpha');
        $this->form_validation->set_rules('dni', 'DNI', 'required');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('cod_provincia', 'provincia', 'required');

        if ($this->form_validation->run() == FALSE) {//Validación de datos incorrecta
            $cuerpo = $this->load->view('View_registro', array('select' => $select), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario', 'homeactive' => 'active'));
                    
        } else {//Validación de datos correcta
            $cuerpo = $this->load->view('View_registro', array('select' => $select), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario', 'homeactive' => 'active'));
        }
    }

}
