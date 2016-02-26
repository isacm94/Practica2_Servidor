<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Incluimos definición de clase padre
require_once(APPPATH.'/libraries/JSON_WebServer_Controller.php');

/**
 * CONTROLADOR que facilita que otra aplicación pueda mostrar y acceder a nuestros productos.
 */
class Agregador extends JSON_WebServer_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Mdl_Agregador', 'tienda');
        
        // Registramos funciones disponibles
        $this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
        $this->RegisterFunction('Lista(offset, limit)', 
                'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
    }

    /**
     * Devuelve el número de elementos a mostrar en el agregador de tiendas
     * @return Int Número de elementos
     */
    public function Total()
    {
        return $this->tienda->Total();
    }
    
    /**
     * Devuelve los productos a mostrar en el agregador de tiendas
     * @param Int $offset Desde que registro tiene que devolver
     * @param Int $limit Hasta que registro tiene que devolver
     * @return Objetos Camisetas
     */
    public function Lista($offset, $limit)
    {
        return $this->tienda->Lista($offset, $limit);
    }
    
}