<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RestablecerCont extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->library('form_validation');
        $this->load->model('Mdl_usuarios');
        $this->load->library('email');
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
            $this->EnviaCorreo();
            
            $cuerpo = $this->load->view('View_mailCorrecto', Array('' => ''), true);
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

    private function EnviaCorreo() {
        // Utilizando sendmail
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
        $this->email->to('isacm94@gmail.com');
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Restablece la contraseña en Camisetas de Fútbol');
        $this->email->message('HOLA MUNDO!!!!!');

        if ($this->email->send()) {
            echo "<pre>\n\nENVIADO CON EXITO\n</pre>";
        } else {
            echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
        }

        echo $this->email->print_debugger();
    }

}
