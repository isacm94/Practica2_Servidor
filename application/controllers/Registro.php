<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->helper('url');
        $this->load->helper('CreaSelect');
        $this->load->helper('dni');
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

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger msgerror"><b>¡Error! </b>', '</div>');

        //Establecemos los mensajes de errores
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('alpha', 'El campo %s no puede contener números');        
        $this->form_validation->set_message('dni_check', 'Formato de DNI incorrecto');

        //Establecemos reglas de validación para el formulario
        $this->form_validation->set_rules('nombre_usu', 'nombre de usuario', 'required');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('rep_clave', 'repita contraseña', 'required');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('nombre_persona', 'nombre', 'required|alpha');
        $this->form_validation->set_rules('apellidos_persona', 'apellidos', 'required|alpha');
        $this->form_validation->set_rules('dni', 'DNI', 'required|exact_length[9]|callback_dni_check');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('cod_provincia', 'provincia', 'required');

        if ($this->form_validation->run() == FALSE || ! claves_check($_POST['clave'], $_POST['rep_clave'])) {//Validación de datos incorrecta
            $errorclave= '';
            
            if(! claves_check($_POST['clave'], $_POST['rep_clave'])){
                echo 'fallo claves';
                    $errorclave = '<div class="alert alert-danger msgerror"><b>¡Error! </b> Las contraseñas no son iguales</div>';
            }
            $cuerpo = $this->load->view('View_registro', array('select' => $select), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario', 'homeactive' => 'active', 'errorclave' => $errorclave));
        } 
        else {//Validación de datos correcta
            echo 'todo bien';
            $cuerpo = $this->load->view('View_registro', array('select' => $select), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario', 'homeactive' => 'active'));
        }
    }

    function dni_check($dni) {
        
       $numerosDNI = substr($dni, 0, 8);
       $letraDNI = substr($dni, 8, 1);
       $letraDNI = strtoupper($letraDNI);
       
       if(is_numeric($numerosDNI) && ($letraDNI == dni_LetraNIF($dni)))
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
    }
}
