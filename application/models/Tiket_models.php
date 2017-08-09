<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tiket_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('tiket', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {

            $this->db->trans_commit();
        }
    }

    function eliminar($idtiket) {
        $this->db->where('idTiket', $idtiket);
        $this->db->delete('tiket');
    }

    function buscarver($idtiket) {
        $this->db->where('idTiket', $idtiket);
        $this->db->where('estado', "PEDIENTE");
        $query = $this->db->get('tiket');
        if ($query->num_rows() != 0) {
            
            return 1;
        } else {
            return 0;
        }
    }

    function buscartiket($folio, $tipo) {
        $this->db->where('folio', $folio);
        $this->db->where('tipo', $tipo);
        $this->db->where('estado', "temporal");
        $query = $this->db->get('tiket');
        if ($query->num_rows() != 0) {
            $row = $query->row();
            return $row->idTiket;
        } else {
            return -1;
        }
    }

    function buscartiketHorafinal($idtiket) {
        $this->db->where('idTiket', $idtiket);
        $query = $this->db->get('tiket');
        $row = $query->row();
        if ($row->registro_fin_pedido != null) {
            return $row->registro_fin_pedido;
        } else {
            return -1;
        }
    }

    function hora_final_pedido($minutos) {
        $Qquery = "select hora(SYSDATE(),$minutos) as hora from tiket";
        $query = $this->db->query($Qquery);
        $row = $query->row();
        return $row->hora;
    }

    function buscar($idTiket) {
        $Qquery = "select 
    t . *, a.nombre_agencia, u.nombre usuario , u.primer_apellido, a.idAgencias 
from
    usuario u,
    agencias a,
    tiket t
where
    t.idAgencias = a.idAgencias
        and t.idUsuario = u.idUsuario
        and t.idTiket = $idTiket";

        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

    function getmostrar($sucursal, $tipo, $offset, $limin) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = $tipo
        and t.idAgencias = $sucursal limit $offset,$limin";

        //  echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

    function getmostrarcountbuscar($sucursal, $tipo, $usuario, $desc, $folio, $ini, $fina) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = $tipo
        and t.idAgencias = $sucursal and CONCAT(u.nombre,' ',u.primer_apellido) like'%$usuario%' and t.descripcion like '%$desc%' and t.folio like '%$folio%'";
        if ($ini != "" && $fina != "") {
            $Qquery .="  and registro_inicial BETWEEN '$ini' AND '$fina'";
        } else {
            if ($ini != "") {
                $Qquery .=" and registro_inicial like '%$ini%'";
            }
            if ($fina != "") {
                $Qquery .=" and registro_inicial like '%$fina%'";
            }
        }
        // echo $Qquery;
        $query = $this->db->query($Qquery);

        return $query->num_rows();
    }

    function getmostrarbuscar($sucursal, $tipo, $usuario, $desc, $folio, $ini, $fina, $offset, $limin) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = $tipo
       and t.idAgencias = $sucursal and CONCAT(u.nombre,' ',u.primer_apellido) like'%$usuario%' and t.descripcion like '%$desc%' and t.folio like '%$folio%'";
        if ($ini != "" && $fina != "") {
            $Qquery .="  and registro_inicial BETWEEN '$ini' AND '$fina'";
        } else {
            if ($ini != "") {
                $Qquery .=" and registro_inicial like '%$ini%'";
            }
            if ($fina != "") {
                $Qquery .=" and registro_inicial like '%$fina%'";
            }
        }
        $Qquery .="limit $offset,$limin";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

    function getmostrarcount($sucursal, $tipo) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = $tipo
        and t.idAgencias = $sucursal";


        $query = $this->db->query($Qquery);

        return $query->num_rows();
    }

    function buscarImpresion($folio, $tipo) {
        $this->db->where('folio', $folio);
        $this->db->where('tipo', $tipo);
        $this->db->where('estado', 'aceptado');
        $query = $this->db->get('tiket');
        if ($query->num_rows() != 0) {

            return 1;
        } else {
            return 0;
        }
    }

    function update($id, $data) {
        $this->db->trans_begin();
        $this->db->where('idTiket', $id);
        $this->db->update('tiket', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function folio($idAgencias, $tipo) {
        $Qquery = "select 
    ifnull(max(folio), 0) as folio
from
    tiket
where
    idAgencias = $idAgencias and estado != 'temporal' and tipo=$tipo"; //limit 0,20
        //echo $Qquery;
        $query = $this->db->query($Qquery);
        $row = $query->row();
        return $row->folio;
    }

    function updatelibre($id, $data) {

        $this->db->where('idTiket', $id);
        $this->db->update('tiket', $data);
    }

    function imprimirtiketAceptar($id, $data, $entradasx, $idAgencia) {

        $this->db->trans_begin();

        //Actualizar

        $this->tiket_models->updatelibre($id, $data);
        //Fin




        $this->load->model('existencias_models');

        if (isset($entradasx)) {
            foreach ($entradasx->result() as $rowy) {
                $valo = $this->existencias_models->comprobrarproducto($rowy->idProductos, $idAgencia);
                if ($valo == -1) {
                    //insertara
                  //  echo "se va inservar";
                    $datayc = array(
                        'cantidada_salidas' => $rowy->cantidad,
                        'idProductos' => $rowy->idProductos,
                        'idAgencias' => $idAgencia,
                        'existencia' => $rowy->cantidad*-1);
                    $this->existencias_models->insertar($datayc);
                } else {
                   // echo "se va Update";
                    $idExistencias = $valo[0];
                    $cantidad_entradas = $valo[1];
                    $cantidada_salidas = $valo[2];

                    $entrada = $cantidada_salidas + $rowy->cantidad;
                    $datayc = array(
                        'cantidada_salidas' => $entrada,
                        'existencia' => $cantidad_entradas - $entrada);

                    $this->existencias_models->update($idExistencias, $datayc);
                }
            }
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function imprimirtiket($id, $data, $dataf, $entradasx, $fecha, $idAgencia) {

        $this->db->trans_begin();

        //Actualizar

        $this->tiket_models->updatelibre($id, $data);
        //Fin


        $this->tiket_models->updatelibre($id, $dataf);

        $this->load->model('existencias_models');

        if (isset($entradasx)) {
            foreach ($entradasx->result() as $rowy) {
                $valo = $this->existencias_models->comprobrarproducto($rowy->idProductos, $idAgencia);
                if ($valo == -1) {
                    //insertara

                    $datayc = array(
                        'cantidad_entradas' => $rowy->cantidad,
                        'idProductos' => $rowy->idProductos,
                        'idAgencias' => $idAgencia,
                        'existencia' => $rowy->cantidad,
                        'registro' => $fecha);
                    $this->existencias_models->insertar($datayc);
                } else {

                    $idExistencias = $valo[0];
                    $cantidad_entradas = $valo[1];
                    $cantidada_salidas = $valo[2];

                    $entrada = $cantidad_entradas + $rowy->cantidad;
                    $datayc = array(
                        'cantidad_entradas' => $entrada,
                        'existencia' => $entrada - $cantidada_salidas,
                        'registro' => $fecha);

                    $this->existencias_models->update($idExistencias, $datayc);
                }
            }
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function tiketpermisos($id, $data) {

        $this->db->trans_begin();


        $this->db->where('idTiket', $id);
        $this->db->update('tiket', $data);




        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function imprimirtiketsalida($id, $data, $dataf) {

        $this->db->trans_begin();

        //Actualizar

        $this->tiket_models->updatelibre($id, $data);
        //Fin


        $this->tiket_models->updatelibre($id, $dataf);




        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function getmostrarbuscarpedidos($sucursal, $usuario, $desc, $folio, $ini, $fina, $offset, $limin) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = 2
       and a.nombre_agencia like '%$sucursal%' and CONCAT(u.nombre,' ',u.primer_apellido) like'%$usuario%' and t.descripcion like '%$desc%' and t.folio like '%$folio%'";
        if ($ini != "" && $fina != "") {
            $Qquery .="  and registro_inicial BETWEEN '$ini' AND '$fina'";
        } else {
            if ($ini != "") {
                $Qquery .=" and registro_inicial like '%$ini%'";
            }
            if ($fina != "") {
                $Qquery .=" and registro_inicial like '%$fina%'";
            }
        }
        $Qquery .="limit $offset,$limin";
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query;
    }

    function getmostrarbuscarpedidoscout($sucursal, $usuario, $desc, $folio, $ini, $fina) {
        $Qquery = "SELECT 
    t . *, a.nombre_agencia, u.nombre as usuario, u.primer_apellido
FROM
    tiket t,
    usuario u,
    agencias a
where
    u.idUsuario = t.idUsuario
        and t.idAgencias = a.idAgencias
        and t.estado != 'temporal'
        and t.tipo = 2
       and a.nombre_agencia like '%$sucursal%' and CONCAT(u.nombre,' ',u.primer_apellido) like'%$usuario%' and t.descripcion like '%$desc%' and t.folio like '%$folio%'";
        if ($ini != "" && $fina != "") {
            $Qquery .="  and registro_inicial BETWEEN '$ini' AND '$fina'";
        } else {
            if ($ini != "") {
                $Qquery .=" and registro_inicial like '%$ini%'";
            }
            if ($fina != "") {
                $Qquery .=" and registro_inicial like '%$fina%'";
            }
        }
        // echo $Qquery;
        $query = $this->db->query($Qquery);
        return $query->num_rows();
    }

}