<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Etiquetas extends CI_Controller {

  private $limite = 10;
  function __construct() {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->model('etiqueta_models');
    $this->load->library('pagination');
    $datoiniciar = $this->session->userdata('nombre');

    if (strlen($datoiniciar) == 0) {


      redirect('', 'refresh');
    }
  }



  public function mostrar() {



    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
      $offset = 0;
    }
    $codigo= $this->input->get('codigo');
    $formato= $this->input->get('formato');

        $data['codigos'] = $this->etiqueta_models->getmostrar($codigo,$formato,$offset, $this->limite);

        $config['base_url'] = base_url() . 'etiquetas/mostrar?codigo='.$codigo.'&formato='.$formato; 
        $config['total_rows'] = $this->etiqueta_models->getmostrarCount($codigo,$formato);
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


        $data["pagination"] = $this->pagination->create_links();
        $mens=4;

        if(!empty ($this->input->get('op'))){

          $mens = $this->input->get('op');
        }
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['msn'] =$mens;
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        
        $this->load->view('etiquetas/lista_viewer', $data);


      }


      public function imprimir() {


       $id= $this->input->get('idEtiqueta');

       $data['etiqueta'] = $this->etiqueta_models->buscar($id);
       $this->load->view('etiquetas/imprimir_viewer', $data);



     }


   }

   /* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */