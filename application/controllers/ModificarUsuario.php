<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR en que cada usuario puede modificar su cuenta en la aplicación.
 * Sólo se podrá acceder a este controlador si se ha iniciado sesión.
 */
class ModificarUsuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('CreaSelect');
        $this->load->library('form_validation');
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_usuarios');
        $this->load->helper('claves');
    }

    public function index() {

        if (!SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $provincias = $this->Mdl_provincias->getProvincias();
        $datos = $this->Mdl_usuarios->getDatosModificar($this->session->userdata('username'));

        $select = CreaSelectMod($provincias, 'cod_provincia', $datos['cod_provincia']);

        $cuerpo = $this->load->view('View_modificarUsuario', array('select' => $select, 'datos' => $datos), true);

        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario', 'homeactive' => 'active'));
    }

    public function Modificar() {

        if (SesionIniciadaCheck()) {
            $todocorrecto = TRUE;
            $cambiarclave = FALSE;

            $provincias = $this->Mdl_provincias->getProvincias();
            $select = CreaSelect($provincias, 'cod_provincia');

            $datos = $this->Mdl_usuarios->getDatosModificar($this->session->userdata('username'));

            //Establecemos los mensajes de errores
            $this->setMensajesErrores();
            //Establecemos reglas de validación para el formulario
            $this->setReglasValidacion();

            if ($this->form_validation->run() == FALSE) {//Validación de datos incorrecta
                $cuerpo = $this->load->view('View_modificarUsuario', array('select' => $select, 'datos' => $datos), true);
                $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                    'homeactive' => 'active'));

                $todocorrecto = FALSE;
            } else if (!EMPTY($this->input->post('clave_nueva')) || !EMPTY($this->input->post('rep_clave_nueva'))) {//Si se ha introducido una de las dos claves para mofificar
                //Tienen que ser las dos claves iguales
                $cambiarclave = TRUE;
                if (!claves_check($this->input->post('clave_nueva'), $this->input->post('rep_clave_nueva'))) {

                    $errorclave = '<div class="alert alert-danger msgerror"><b>¡Error! </b> Las contraseñas no son iguales</div>';
                    $cuerpo = $this->load->view('View_modificarUsuario', array('select' => $select, 'errorclave' => $errorclave, 'datos' => $datos), true);
                    $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                        'homeactive' => 'active'));

                    $todocorrecto = FALSE;
                }
            }

            if ($todocorrecto) {

                echo "4";
                //Crea el array de los datos a insertar en la tabla usuario
                foreach ($this->input->post() as $key => $value) {
                    if ($key == 'clave_nueva' && $cambiarclave) {
                        $data['clave'] = password_hash($value, PASSWORD_DEFAULT);
                    } else if ($key == 'clave' && !$cambiarclave) {
                        $data['clave'] = password_hash($value, PASSWORD_DEFAULT);
                    }

                    if ($key != 'rep_clave_nueva' && $key != 'GuardarUsuario' && $key != 'clave_nueva' && $key != 'clave')
                        $data[$key] = $value;
                }

                $datos = array(
                    'username' => $this->input->post('nombre_usu')
                );
                $this->session->set_userdata($datos);
                $this->Mdl_usuarios->updateUsuario($this->session->userdata('userid'), $data); //Inserta en la tabla usuario

                redirect('ModificarCorrecto', 'location', 301);
            }
        } else {
            redirect('Error404', 'location', 301);
        }
    }

    function nombreUsuRepetido_check($nombre_usu) {

        $countNomUsuario = $this->Mdl_usuarios->getCount_NombreUsuarioModificar($nombre_usu, $this->session->userdata('userid'));

        if ($countNomUsuario == 0) {//No existen nombres guardados
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function clavecorrecta_check() {

        if (password_verify($this->input->post('clave'), $this->Mdl_usuarios->getClave($this->session->userdata('username'))))
            return TRUE;
        else
            return FALSE;
    }

    function setMensajesErrores() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser númerico');
        //$this->form_validation->set_message('dni_check', 'Formato de DNI incorrecto');
        $this->form_validation->set_message('nombreUsuRepetido_check', 'El nombre de usuario ya existe');
        $this->form_validation->set_message('clavecorrecta_check', 'La contraseña es incorrecta');
    }

    function setReglasValidacion() {
        $this->form_validation->set_rules('nombre_usu', 'nombre de usuario', 'required|callback_nombreUsuRepetido_check');
        $this->form_validation->set_rules('clave', 'contraseña', 'required|callback_clavecorrecta_check');
        //$this->form_validation->set_rules('rep_clave', 'repita contraseña', 'required');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        //$this->form_validation->set_rules('nombre_persona', 'nombre', 'required');
        //$this->form_validation->set_rules('apellidos_persona', 'apellidos', 'required');
        //$this->form_validation->set_rules('dni', 'DNI', 'required|exact_length[9]|callback_dni_check');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('cod_provincia', 'provincia', 'required');
    }

}
