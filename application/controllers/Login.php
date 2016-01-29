<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_usuarios');
    }

    public function index() {

        if ($this->input->post('entrar')) {//Botón entrar pulsado
            if ($this->Mdl_usuarios->getCount_NombreUsuario($this->input->post('username')) > 0) {//Existe Usuario
                if (password_verify($this->input->post('clave'), $this->Mdl_usuarios->getClave($this->input->post('username')))) {
                    //la clave es correcta
                    $this->Login($this->input->post('username'));

                    //redirect('', 'location', 301);
                } else {
                    $this->MuestraErrorEnVista();
                }
            } else {
                $this->MuestraErrorEnVista();
            }
        } else {
            $cuerpo = $this->load->view('View_login', '', true); //Generamos la vista
            $this->load->view('View_plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        }
    }

    public function Login($username) {
        $datos = array(
            'username' => $username,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($datos);

        redirect('', 'location', 301);
    }

    public function Logout() {

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');

        redirect('', 'location', 301);
    }

    public function MuestraErrorEnVista() {
        $error = "<div class='alert msgerror'><b>¡Error!</b> Usuario o contraseña incorrectos</div>";
        $cuerpo = $this->load->view('View_login', array('error' => $error), true); //Generamos la vista
        $this->load->view('View_plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }

}
