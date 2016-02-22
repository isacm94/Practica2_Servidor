<?php

/**
 * MODELO que recuperar las camisetas que estén seleccionadas en la tabla camisetas.
 */
class Mdl_Agregador extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('Mdl_seleccionadas');
    }

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
