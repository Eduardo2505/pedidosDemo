<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Existencias_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->insert('existencias', $data);
    }

    function update($id, $data) {

        $this->db->where('idExistencias', $id);
        $this->db->update('existencias', $data);
    }

    function comprobrarproducto($idProducto, $idagencia) {

        $this->db->where('idProductos', $idProducto);
        $this->db->where('idAgencias', $idagencia);
        $query = $this->db->get('existencias');

        if ($query->num_rows() != 0) {
            $row = $query->row();
            $data = array($row->idExistencias, $row->cantidad_entradas, $row->cantidada_salidas);
            return $data;
        } else {
            return -1;
        }
    }

    function mostrar($idagencia, $nomproducto, $nomcategoria,$talla, $fecaini, $fechfin, $offset, $limin) {
        $SQl = "SELECT 
    p.nombre,
    p.talla,
    c.Nombre,
    e.registro,
    e.cantidad_entradas,
    e.cantidada_salidas,
    e.existencia
FROM
    existencias e,
    productos p,
    categorias c
where
    p.idProductos = e.idProductos
        and c.idCategorias = p.idCategorias
        and p.nombre like '%$nomproducto%'
        and c.Nombre like '%$nomcategoria%' and p.talla like '%$talla%'
        and e.idAgencias like  '%$idagencia%' ";
        if ($fecaini != "" && $fechfin != "") {
            $SQl .=" and e.registro BETWEEN '$fecaini' and '$fechfin'";
        } else {
            $SQl .=" limit $offset , $limin";
        }
        
        $query = $this->db->query($SQl);

        return $query;
    }
    function mostrarcount($idagencia, $nomproducto, $nomcategoria,$talla, $fecaini,$fechfin) {
        $SQl = "SELECT 
    p.nombre,
    p.talla,
    c.Nombre,
    e.registro,
    e.cantidad_entradas,
    e.cantidada_salidas,
    e.existencia
FROM
    existencias e,
    productos p,
    categorias c
where
    p.idProductos = e.idProductos
        and c.idCategorias = p.idCategorias
        and p.nombre like '%$nomproducto%'
        and c.Nombre like '%$nomcategoria%' and p.talla like '%$talla%'
        and e.idAgencias like  '%$idagencia%'";
        if ($fecaini != "" && $fechfin != "") {
            $SQl .=" and e.registro BETWEEN '$fecaini' and '$fechfin'";
        } 
    
        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

}