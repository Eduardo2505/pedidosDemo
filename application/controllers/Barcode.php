<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Barcode extends CI_Controller {


  function __construct() {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $datoiniciar = $this->session->userdata('nombre');

    if (strlen($datoiniciar) == 0) {


      redirect('', 'refresh');
    }

  }


  public function index() {

    $mens=4;

    if(!empty ($this->input->get('op'))){

      $mens = $this->input->get('op');
    }
    $datam['acceso'] = $this->session->userdata('acceso');
    $data['msn'] =$mens;
    $data['menu'] = $this->load->view('plantilla/menu', $datam, true);


    $this->load->view('barcode/captura', $data);

  }

  


  public function imprimir() {


   $cedis= $this->input->post('cedis');
   $oc= $this->input->post('oc');
   $upc1= $this->input->post('upc1');
   $upc2= $this->input->post('upc2');
   
   $numcaja= $this->input->post('numcaja');
   $pzaupc1= $this->input->post('pzaupc1');
   $pzaupc2= $this->input->post('pzaupc2');
   $cajaTotal= $this->input->post('cajaTotal');

   $pzat= $pzaupc1+ $pzaupc2;


   
   $data['cedis'] = $cedis;
   $data['oc'] = $oc;
   $data['upc1'] = $upc1;
   $data['upc2'] = $upc2;
   $data['pzat'] = $pzat;
   $data['numcaja'] = $numcaja;
   $data['pzaupc1'] = $pzaupc1;
   $data['pzaupc2'] = $pzaupc2;
   $data['cajaTotal'] = $cajaTotal;
   $this->load->view('barcode/imprimir_viewer', $data);



 }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */