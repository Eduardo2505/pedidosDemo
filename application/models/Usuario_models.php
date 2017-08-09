<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function login($email, $password) {
        $sql = "SELECT 
    u . *, a.nombre_agencia,a.descripcion
FROM
    usuario u,
    agencias a
where
    a.idAgencias = u.idAgencias
        and u.email = '$email'
        and u.contrasena = '$password'";

        $query = $this->db->query($sql);
        return $query;
    }
     function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('usuario', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {

            $this->db->trans_commit();
        }
    }


    function getmostrar($nombre,$apellido,$email,$agencia, $offset, $limin) {
       
        $Qquery = "SELECT 
    *
FROM
    usuario u,
    agencias a
WHERE
    u.idAgencias = a.idAgencias
        AND u.nombre LIKE '%$nombre%'
        AND u.primer_apellido LIKE '%$apellido%'
        AND u.email LIKE '%$email%'
        AND a.nombre_agencia LIKE '%$agencia%'";
   
        $Qquery .=" limit $offset,$limin";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

     function getmostrarCount($nombre,$apellido,$email,$agencia) {
       
        $Qquery = "SELECT 
    *
FROM
    usuario u,
    agencias a
WHERE
    u.idAgencias = a.idAgencias
        AND u.nombre LIKE '%$nombre%'
        AND u.primer_apellido LIKE '%$apellido%'
        AND u.email LIKE '%$email%'
        AND a.nombre_agencia LIKE '%$agencia%'";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query->num_rows();
    }


     function delete($id) {
        $this->db->trans_begin();
        $this->db->where('idUsuario', $id);
        $this->db->delete('usuario');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

      function update($id, $data) {
        $this->db->trans_begin();
        $this->db->where('idUsuario', $id);
        $this->db->update('usuario', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function buscar($id) {

        $this->db->where('idUsuario', $id);
        $query = $this->db->get('usuario');

        return $query;
    }



}