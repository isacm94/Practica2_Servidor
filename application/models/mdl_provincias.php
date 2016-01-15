<?php

class mdl_provincias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getProvincias() {

        $query = $this->db->query("SELECT cod, nombre FROM tbl_provincias");

        return $query->result_array();
    }

    public function InsertarProvincia($data) {

        $this->db->insert('tbl_provincias', $data);
    }

    public function ActualizarProvincia($data, $cod) {

        $this->db->where('cod', $cod);
        $this->db->update('tbl_provincias', $data);
        // Produce:
        // UPDATE mi_tabla
        // SET title = '{$titulo}', name = '{$nombre}', date = '{$fecha}'
        // WHERE id = $id
    }

    public function BorrarProvincia($cod) {

        $this->db->delete('tbl_provincias', array('cod' => $cod));
        // Produce:
        // DELETE FROM mi_tabla
        // WHERE id = $id
    }

    public function getNumProvincias() {
        return $this->db->count_all('tbl_provincias');
    }

    public function NoNombreRepetido($nom, $cod) {
        
        $query = $this->db->query(
                "SELECT count(*) as num FROM tbl_provincias "
                . "WHERE nombre='$nom' AND cod!='$cod'");
        
        $num=$query->row()->num;
        
        return $num;
    }

}
