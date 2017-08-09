<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('salida_models');
        $this->load->model('existencias_models');
        $this->load->model('tiket_models');
    }

    function insertarSal($Salida) {
        $this->db->trans_begin();
        $this->salida_models->insertar($Salida);
       
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    function eliminarSal($idSalida) {
        $this->db->trans_begin();
        $this->salida_models->delete($idSalida);
       
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    function updateSal($idsalida,$datayc) {
        $this->db->trans_begin();
        $this->salida_models->update($idsalida,$datayc);
       
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function insertar($Salida, $idExistencias, $datayc) {
        $this->db->trans_begin();
        $this->salida_models->insertar($Salida);
        $this->existencias_models->update($idExistencias, $datayc);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function update($identrada, $datay, $idExistencias, $datayc) {
        $this->db->trans_begin();
        $this->salida_models->update($identrada, $datay);
        $this->existencias_models->update($idExistencias, $datayc);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function delete($identrada, $idExistencias, $datayc) {
        $this->db->trans_begin();
        $this->salida_models->delete($identrada);
        $this->existencias_models->update($idExistencias, $datayc);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function limpiar($salidas, $idAgencia, $idtiket) {
        $this->db->trans_begin();

        if (isset($salidas)) {
            foreach ($salidas->result() as $rowy) {
                $valo = $this->existencias_models->comprobrarproducto($rowy->idProductos, $idAgencia);


                $idExistencias = $valo[0];
                $cantidad_entradas = $valo[1];
                $cantidada_salidas = $valo[2];

                $cansalida = $cantidada_salidas - $rowy->cantidad;
                $datayc = array(
                    'cantidada_salidas' => $cansalida,
                    'existencia' => $cantidad_entradas - $cansalida);

                $this->existencias_models->update($idExistencias, $datayc);
            }
        }
        $this->tiket_models->eliminar($idtiket);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

}