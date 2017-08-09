<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agencias_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('agencias', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {

            $this->db->trans_commit();
        }
    }

     function buscar($id) {

        $this->db->where('idAgencias', $id);
        $query = $this->db->get('agencias');

        return $query;
    }
    
     function get() {
        $this->load->model('productos_models');
        
        $query = $this->db->get('agencias');
     
        return $query;
    }


   function getmostrar($nombre_agencia,$descripcion, $offset, $limin) {
       
        $Qquery = "SELECT 
    *
FROM
    agencias
WHERE
    nombre_agencia LIKE '%$nombre_agencia%'
        AND descripcion LIKE '%$descripcion%' order by nombre_agencia ";
   
        $Qquery .=" limit $offset,$limin";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

     function getmostrarCount($nombre_agencia,$descripcion) {
       
        $Qquery = "SELECT 
    *
FROM
    agencias
WHERE
    nombre_agencia LIKE '%$nombre_agencia%'
        AND descripcion LIKE '%$descripcion%'";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query->num_rows();
    }


     function delete($id) {
        $this->db->trans_begin();
        $this->db->where('idAgencias', $id);
        $this->db->delete('agencias');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

      function update($id, $data) {
        $this->db->trans_begin();
        $this->db->where('idAgencias', $id);
        $this->db->update('agencias', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

}