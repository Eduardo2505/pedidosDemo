<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getBuscar($string) {
        $Qquery = "SELECT 
    p.idProductos,
    p.nombre,
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
        and concat(p.nombre, '', c.Nombre) like '%%'
limit 0 , 10"; //limit 0,20

       // echo $Qquery;
        $query = $this->db->query($Qquery);

        return $query;
    }

}