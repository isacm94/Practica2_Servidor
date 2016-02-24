<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * CONTROLADOR en el que se lleva a cabo el proceso de cambiar la contraseña de usuario a tráves del correo.
 */
class RestablecerContrasenha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->library('form_validation');
        $this->load->model('Mdl_usuarios');
        $this->load->model('Mdl_restablecerCont');
        $this->load->model('Mdl_mail');
        $this->load->library('email');
        $this->load->helper('claves');
    }

    public function index() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('ExisteUsuario_check', 'No existe el usuario introducido');
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|callback_ExisteUsuario_check');

        if ($this->form_validation->run() == FALSE) {
            $cuerpo = $this->load->view('View_RestablecerCont', Array('' => ''), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Reestablecer Contraseña'));
        } else {

            $datos = $this->Mdl_mail->getDatosFromUsername($this->input->post('username'));
            $this->EnviaCorreo($datos);

            $cuerpo = $this->load->view('View_mailCorrecto', Array('correo' => $datos['correo']), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Mail correcto'));
        }
    }

    public function ExisteUsuario_check($username) {
        if ($this->Mdl_usuarios->getCount_NombreUsuario($username) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function EnviaCorreo($datos) {
        // Utilizando sendmail
//        $config['protocol'] = 'sendmail';
//        $config['smtp_host'] = 'mail.iessansebastian.com';
//        $config['smtp_user'] = 'aula4@iessansebastian.com';
//        $config['smtp_pass'] = 'daw2alumno';
        
        /*$config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'camisetasdefutbol.2daw@gmail.com';
        $config['smtp_pass'] = 'camisetasdefutbol';
        $config['smtp_timeout'] = '7';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not*/

        //$this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
        $this->email->to($datos['correo']);
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Restablece la contraseña en Camisetas de Fútbol');

        $mensaje = "Restablece la contraseña accediendo a la siguiente dirección: ";
        $mensaje.= site_url() . "/RestablecerContrasenha/Restablece/" . $datos['id'] . "/" . $this->getTonken($datos['id'], $datos['dni'], $datos['nombre']);
        $this->email->message($mensaje);

        if (!$this->email->send())
            echo "<pre>\n\nError enviado mail\n</pre>";


        //echo $this->email->print_debugger();
    }

    private function getTonken($id, $dni, $nombre) {
        return sha1($id . $dni . $nombre);
    }

    public function Restablece($id, $token) {
        if ($this->Mdl_restablecerCont->getDatosFromId($id) != -1) {
            $datos = $this->Mdl_restablecerCont->getDatosFromId($id);

            if ($this->getTonken($datos['id'], $datos['dni'], $datos['nombre']) == $token) {
                $this->PideClaveRestablecer($datos['username']);
            } else {
                $cuerpo = $this->load->view('View_error404', Array('' => ''), true);
                $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
            }
        } else {
            $cuerpo = $this->load->view('View_error404', Array('' => ''), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
        }
    }

    public function PideClaveRestablecer($username) {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('ClavesIguales_check', 'Las contraseñas deben ser iguales');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('clave_rep', 'repita contraseña', 'required|callback_ClavesIguales_check');

        if ($this->form_validation->run() == FALSE) {
            $cuerpo = $this->load->view('View_pideClaveRes', Array('username' => $username), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Restablecer Contraseña'));
        } else {

            $this->Mdl_restablecerCont->UpdateClave($this->input->post('username'), password_hash($this->input->post('clave'), PASSWORD_DEFAULT));

            $cuerpo = $this->load->view('View_contrasenhaCorrecta', Array(), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Restablecer Contraseña'));
        }
    }

    public function ClavesIguales_check() {
        if (claves_check($this->input->post('clave'), $this->input->post('clave_rep')))
            return TRUE;
        else
            return FALSE;
    }

}
