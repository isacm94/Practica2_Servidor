<?php

/**
 * MODELO que gestiona el acceso a los datos para el agregador de tiendas.
 */
class Mdl_Agregador extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('Mdl_seleccionadas');
    }

    /**
     * Devuelve las camisetas seleccionadas
     * @param Int $limit
     * @param Int $start
     * @return Array Camisetas Seleccionadas
     */
    public function Lista($limit, $start) {
        $lista = $this->Mdl_seleccionadas->getSeleccionadas($start, $limit);
        $listaProductos = array();

        foreach ($lista as $key => $value) {
            $listaProductos[$key] = array(
                'nombre' => $value['nombre_cam'],
                'descripcion' => $value['descripcion'],
                'precio' => $value['precio'],
                'img' => base_url() . 'assets/img/imagesAPP/' . $value['imagen'],
                'url' => site_url('Carrito/comprar/' . $value['idCamiseta'])
            );
        }
        
        return $listaProductos;
    }

    /**
     * Número total de camisetas seleccionadas
     * @return Int Nº Camisetas
     */
    public function Total() {
        $query = $this->db->query("SELECT cam.idCamiseta "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND cam.seleccionada = 1 "
                . "AND cam.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin ");
        return $query->num_rows();
    }

}
