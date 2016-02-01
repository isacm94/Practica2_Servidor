<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_usuarios');
    }

    public function index() {

        if (!SesionIniciadaCheck()) {//Sólo ir a login si no está sesión inicada, por si entra por url
            if ($this->input->post('entrar')) {//Botón entrar pulsado
                if ($this->Mdl_usuarios->getCount_NombreUsuario($this->input->post('username')) > 0) {//Existe Usuario
                    if (password_verify($this->input->post('clave'), $this->Mdl_usuarios->getClave($this->input->post('username')))) {
                        //la clave es correcta
                        $this->Login($this->input->post('username'));
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
        } else {
            $cuerpo = $this->load->view('View_error404', '', true); //Generamos la vista
            $this->load->view('View_plantilla', Array('titulo' => 'Error 404', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        }
    }

    public function Login($username) {

        if ($username) {
            $datos = array(
                'username' => $username,
                'userid' => $this->Mdl_usuarios->getId($username),
                'logged_in' => TRUE
            );

            $this->session->set_userdata($datos);
        }
        redirect('', 'location', 301);
    }

    public function Logout() {

        if (SesionIniciadaCheck()) {//Sólo puede cerrar sesión si está iniciada, por si entra por url
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('logged_in');

            $this->myCarrito->destroy(); //Borramos también su carrito
            redirect('', 'location', 301);
        } else {
            $cuerpo = $this->load->view('View_error404', '', true); //Generamos la vista
            $this->load->view('View_plantilla', Array('titulo' => 'Error 404', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        }
    }

    public function MuestraErrorEnVista() {
        $error = "<div class='alert msgerror'><b>¡Error!</b> Usuario o contraseña incorrectos</div>";
        $cuerpo = $this->load->view('View_login', array('error' => $error), true); //Generamos la vista
        $this->load->view('View_plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }

}
