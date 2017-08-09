<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Walmart_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db_b = $this->load->database('walmart', true);  

    }

    function getmostrar($determinante, $offset, $limin) {

     $Qquery = ""; 
     if($determinante!=""){
        $Qquery .= "SELECT 
    *
        FROM
        pedidos
        WHERE
        determinante = '$determinante'";
    }else{
       $Qquery .= "SELECT 
    *
       FROM
       pedidos";

   }




   $Qquery .=" limit $offset,$limin";
   $query = $this->db_b->query($Qquery);
   return $query;
}

function getmostrarCount($determinante) {

    $Qquery = ""; 
    if($determinante!=""){
        $Qquery .= "SELECT 
    *
        FROM
        pedidos
        WHERE
        determinante = '$determinante'";
    }else{
       $Qquery .= "SELECT 
    *
       FROM
       pedidos";

   }
   $query = $this->db_b->query($Qquery);
   return $query->num_rows();
}

function buscar($id) {

    $this->db_b->where('idpedidos', $id);
    $query = $this->db_b->get('pedidos');

    return $query;
}



      function hora() {

         $Qquery = "select now() as hora"; 
         $query = $this->db_b->query($Qquery);


        $row = $query->row();

        return $row->hora;
    }

}