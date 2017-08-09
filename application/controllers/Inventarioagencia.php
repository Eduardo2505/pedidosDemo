<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventarioagencia extends CI_Controller {

    private $limite = 10;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pagination');
        $datoiniciar = $this->session->userdata('nombre');
        $this->load->model('salida_models');

        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        } else {
            $idAgencias = $this->session->userdata('idAgencias');
            //echo  $idAgencias;
            $GLOBALS['idSucursal'] = $idAgencias;
        }
    }

    public function index() {


        



       
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $data['datos'] = $this->salida_models->getSALIDA($GLOBALS['idSucursal'],"");

        $this->load->view('inventario/sucr_lista_viewer', $data);
    }

    public function buscar() {


        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */