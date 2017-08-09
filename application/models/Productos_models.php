<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getBuscar($string,$offset, $limin) {
        $Qquery = "SELECT 
        p.idProductos,
        p.nombre,
        p.url,
        p.talla,
        c.Nombre as categoaria,
        (SELECT 
        IFNULL(sum(e.existencia), 0) as suma
        FROM
        existencias e
        where
        e.idProductos =p.idProductos) as suma
        FROM
        productos p,
        categorias c
        where
        p.idCategorias = c.idCategorias
        and concat(p.nombre, '', c.Nombre) like '%$string%' order by p.nombre
limit $offset, $limin"; //limit 0,20

$query = $this->db->query($Qquery);

return $query;
}

function count($string) {
    $Qquery = "SELECT 
    p.idProductos,
    p.nombre,
    p.talla,
    p.url,
    c.Nombre as categoaria,
    (SELECT 
    IFNULL(sum(e.existencia), 0) as suma
    FROM
    existencias e
    where
    e.idProductos =p.idProductos) as suma
    FROM
    productos p,
    categorias c
    where
    p.idCategorias = c.idCategorias
    and concat(p.nombre, '', c.Nombre) like '%$string%' ";

               // echo $Qquery;
    $query = $this->db->query($Qquery);

    return $query->num_rows();
}



//
function mostrar($string,$talla,$categoria,$offset, $limin) {
    $Qquery = "SELECT 
    p.*,
    c.Nombre as categoaria   
    FROM
    productos p,
    categorias c
    where
    p.idCategorias = c.idCategorias
    and c.Nombre like '%$string%' and p.talla like '%$talla%' and c.Nombre like '%$categoria%'  order by p.nombre
limit $offset, $limin"; //limit 0,20

$query = $this->db->query($Qquery);

return $query;
}

function mostrarcount($string,$talla,$categoria) {
   $Qquery = "SELECT 
   p.*,
   c.Nombre as categoaria   
   FROM
   productos p,
   categorias c
   where
   p.idCategorias = c.idCategorias
   and c.Nombre like '%$string%' and p.talla like '%$talla%' and c.Nombre like '%$categoria%'  order by p.nombre";

               // echo $Qquery;
   $query = $this->db->query($Qquery);

   return $query->num_rows();
}


function insertar($data) {

    $this->db->trans_begin();
    $this->db->insert('productos', $data);
    $id = $this->db->insert_id();
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {

        $this->db->trans_commit();
         return $id;
    }
}

function buscar($id) {

    $this->db->where('idProductos', $id);
    $query = $this->db->get('productos');

    return $query;
}
function delete($id) {
    $this->db->trans_begin();
    $this->db->where('idProductos', $id);
    $this->db->delete('productos');
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {
        $this->db->trans_commit();
    }
}

function update($id, $data) {
    $this->db->trans_begin();
    $this->db->where('idProductos', $id);
    $this->db->update('productos', $data);
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {
        $this->db->trans_commit();
    }
}


  function limpiar($string) {
        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );
        return $string;
    }

}