<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entradas_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function update($id, $data) {
        $this->db->trans_begin();
        $this->db->where('idEntradas', $id);
        $this->db->update('entradas', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function delete($id) {
        $this->db->trans_begin();
        $this->db->where('idEntradas', $id);
        $this->db->delete('entradas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function bucarProductocantidad($idtiket, $idProducto) {

        $this->db->where('idProductos', $idProducto);
        $this->db->where('idTiket', $idtiket);
        $query = $this->db->get('entradas');

        if ($query->num_rows() != 0) {
            $row = $query->row();
           // echo $row->idEntradas;
            $data = array($row->idEntradas, $row->cantidad);
            return $data;
        } else {
            return -1;
        }
    }

    function entradastotal($idtiket) {

        $this->db->where('idEntradas', $idtiket);
        $query = $this->db->get('entradas');


        $row = $query->row();

        return $row->cantidad;
    }
    
    function aumentarentrada($identrada) {
        $this->db->where('idEntradas', $identrada);
        $query = $this->db->get('entradas');
        $row = $query->row();
        return $row->cantidad;
    }

    function insertar($data) {
        $this->db->trans_begin();
        $this->db->insert('entradas', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    

    function getEntradas($idtiket) {
        $SQl = "SELECT 
    e.cantidad, p.nombre, p.talla, e.idEntradas,p.idProductos
FROM
    entradas e,
    productos p
where
    e.idProductos = p.idProductos
        and e.idTiket = '$idtiket' order by e.registro desc";
        $query = $this->db->query($SQl);

        return $query;
    }

}