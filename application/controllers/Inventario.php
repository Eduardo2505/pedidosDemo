<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends CI_Controller {

    private $limite = 10;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pagination');
        $datoiniciar = $this->session->userdata('nombre');
        $this->load->model('existencias_models');

        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        } else {
           // $idAgencias = $this->session->userdata('idAgencias');
            //echo  $idAgencias;
            $GLOBALS['idSucursal'] = 41;
        }
    }

    public function index() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }





        $data['tiketEntradas'] = $this->existencias_models->mostrar("", "", "", "", "", "", $offset, $this->limite);



        $config['base_url'] = base_url() . 'inventario/buscar?producto=&talla=&cate=&fechi=&fechf=';
        $config['total_rows'] = $this->existencias_models->mostrarcount($GLOBALS['idSucursal'], "", "", "", "", "");
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;


        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        

       
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $data["pagination"] = $this->pagination->create_links();
        $this->load->view('inventario/inventario_lista_viewer', $data);
    }

    public function buscar() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        // $sucursalprin = 41;


        $producto = $this->input->get('producto');
        $talla = $this->input->get('talla');
        $cate = $this->input->get('cate');
        $fechi = $this->input->get('fechi');
        $fechf = $this->input->get('fechf');

        $data['tiketEntradas'] = $this->existencias_models->mostrar($GLOBALS['idSucursal'], $producto, $cate, $talla, $fechi, $fechf, $offset, $this->limite);



        $config['base_url'] = base_url() . 'inventario/buscar?producto=' . $producto . '&talla=' . $talla . '&cate=' . $cate . '&fechi=' . $fechi . '&fechf=' . $fechf; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->existencias_models->mostrarcount($GLOBALS['idSucursal'], $producto, $cate, $talla, $fechi, $fechf);
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;


        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        

     
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $data["pagination"] = $this->pagination->create_links();
        $this->load->view('inventario/inventario_lista_viewer', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */