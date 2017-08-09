<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activarpedido extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('tiket_models');
        $this->load->model('salida_models');
    }

    public function index() {
        echo "Entro";
    }

    public function activar() {
        $id = $this->input->get('idtiket');
        $idAgencia = 41;
        $op = $this->input->get('op');
        $msn=0;



        $valorten=$this->tiket_models->buscarver($id);

        if($valorten==1){

            if (strcmp($op, "cancelar") !== 0) {

                $datay = array(
                    'estado' => "ACEPTADO");

                $listaProductosSalida=$this->salida_models->getEntradas($id);
                $this->tiket_models->imprimirtiketAceptar($id, $datay, $listaProductosSalida, $idAgencia);
                $msn=1;

            } else {

                $datay = array(
                    'estado' => "CANCELO");
                $this->tiket_models->tiketpermisos($id, $datay);
                $msn=2;


            }
        }else{

            $msn=3;

        }


        redirect('activarpedido/mensaje?msn='.$msn, 'refresh');

    }

    public function mensaje() {

       $msn = $this->input->get('msn');
       if($msn==1){
           $data['msn'] = 'Se acepto correctamente';
       }else if($msn==2){
        $data['msn'] = 'Se cancelo correctamente';

    }else{
        $data['msn'] = 'Ya se encuentra registrado el pedido';
    }
    
    $this->load->view('pedidos/mensaje.php', $data);
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */