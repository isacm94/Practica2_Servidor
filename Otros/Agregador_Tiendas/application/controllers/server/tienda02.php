<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Incluimos definición de clase padre
require_once(APPPATH.'/libraries/JSON_WebServer_Controller.php');

class Tienda02 extends JSON_WebServer_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('server/gestor_tiendas_model', 'tienda');
        $this->tienda->Load('productos_tienda02');
        
        // Registramos funciones disponibles
        $this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
        $this->RegisterFunction('Lista(offset, limit)', 
                'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
    }

    public function Total()
    {
        return $this->tienda->Total();
    }
    
    public function Lista($offset, $limit)
    {
        return $this->tienda->Lista($offset, $limit);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */