<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Traspasos extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $datoiniciar = $this->session->userdata('nombre');
        $GLOBALS['remote_add'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        }
    }

    public function index() {
        $this->load->view('traspasos_viewer');
    }

    public function mostrar() {
        $this->load->view('traspasos_lista_viewer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */