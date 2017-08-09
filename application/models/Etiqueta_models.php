<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Etiqueta_models extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->db_b = $this->load->database('walmart', true);  

  }

  function getmostrar($codigo,$formato, $offset, $limin) {

   $Qquery = "SELECT 
    *
      FROM
          etiqueta
             WHERE
              codigo LIKE '%$codigo%' AND formato LIKE '%$formato%'"; 

          $Qquery .=" limit $offset,$limin";
            $query = $this->db_b->query($Qquery);
            
   return $query;
 }

 function getmostrarCount($codigo,$formato) {

  $Qquery = "SELECT 
    *
  FROM
  etiqueta
  WHERE
  codigo LIKE '%$codigo%' AND formato LIKE '%$formato%'";

  $query = $this->db_b->query($Qquery);
  return $query->num_rows();
}

function buscar($id) {

  $this->db_b->where('idEtiqueta', $id);
  $query = $this->db_b->get('etiqueta');

  return $query;
}

}