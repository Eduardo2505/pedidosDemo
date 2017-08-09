<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Email extends CI_Controller {


  function __construct() {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('tiket_models');
    $this->load->model('salida_models');
}



public function ver() {

    $idtiket = $this->input->get('idTiket');
    $idAgencia = $this->input->get('idAgencias');
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fecha = $date->format('Y-m-d H:i:s');
    $datay = array(
      'registro_update' => $fecha);
    $this->tiket_models->update($idtiket, $datay);

    $valorten=$this->tiket_models->buscarver($idtiket);

    if($valorten==1){


        $query = $this->tiket_models->buscar($idtiket);
        $row = $query->row();

        $data['entradas'] = $this->salida_models->getEntradas($idtiket);
        $data['des'] = $row->descripcion;
        $data['agencia'] = $row->nombre_agencia;
        $data['fecha'] = $row->registro_inicial;
        $data['fechaac'] = $row->registro_update;
        $data['folio'] = str_pad($row->folio, 5, "0", STR_PAD_LEFT);
        $data['nombre'] = $row->usuario . ' ' . $row->primer_apellido;
        $data['btnsalir'] = '<a href="' . site_url('') . 'pedidos/mostrar" style="color: #333">SALIR</a>';

        $data['tipo'] = 'reimpresion';
        $data['email'] = 'admin';
        $data['btncancelar'] = '<a href="' . site_url('') . 'activarpedido/activar?idtiket=' . $idtiket . '&op=cancelar&idAgencias='.$idAgencia.'" style="color: #FFFFFF">CANCELAR</a>';
        $data['btnacepatr'] = '<a href="' . site_url('') . 'activarpedido/activar?idtiket=' . $idtiket . '&op=aceptar&idAgencias='.$idAgencia.'" style="color: #FFFFFF">ACEPTA</a>';
        $data['tipo'] = 'original';
        $this->load->view('pedidos/email_viewer', $data);
    }else{

       $msn=3;
       redirect('activarpedido/mensaje?msn='.$msn, 'refresh');
   }

}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */