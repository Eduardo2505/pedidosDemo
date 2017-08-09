<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salida_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function update($id, $data) {

        $this->db->where('idSalida', $id);
        $this->db->update('salida', $data);
    }

    function delete($id) {

        $this->db->where('idSalida', $id);
        $this->db->delete('salida');
    }

    function bucarProductocantidad($idtiket, $idProducto) {

        $this->db->where('idProductos', $idProducto);
        $this->db->where('idTiket', $idtiket);
        $query = $this->db->get('salida');

        if ($query->num_rows() != 0) {
            $row = $query->row();
            $data = array($row->idSalida, $row->cantidad);
            return $data;
        } else {
            return -1;
        }
    }

    function entradastotal($idtiket) {

        $this->db->where('idSalida', $idtiket);
        $query = $this->db->get('salida');


        $row = $query->row();
       // echo $row->cantidad;
        return $row->cantidad;
    }

    function aumentarentrada($identrada) {
        $this->db->where('idSalida', $identrada);
        $query = $this->db->get('salida');
        $row = $query->row();
        return $row->cantidad;
    }

    function insertar($data) {

        $this->db->insert('salida', $data);
    }

    function getEntradas($idtiket) {
        $SQl = "SELECT 
    e.cantidad, p.nombre, p.talla, e.idSalida,p.idProductos
FROM
    salida e,
    productos p
where
    e.idProductos = p.idProductos
        and e.idTiket = '$idtiket' order by e.registro desc";
        //  echo   $SQl;
        $query = $this->db->query($SQl);

        return $query;
    }
    
    function getSALIDA($idsucr,$string) {
        $SQl = "SELECT 
    p.nombre nombrepro,
    p.talla talla,
    c.Nombre nomcate,
    Max(e.registro) as registro,
    sum(e.cantidad) as cantidad
FROM
    salida e,
    productos p,
    tiket t,
    categorias c
where
    e.idProductos = p.idProductos
        and c.idCategorias = p.idCategorias
        and t.idTiket = e.idTiket
        and t.idAgencias = $idsucr and t.estado='ACEPTADO'
group by p.idProductos";
        //echo   $SQl;
       $query = $this->db->query($SQl);

        return $query;
    }

}