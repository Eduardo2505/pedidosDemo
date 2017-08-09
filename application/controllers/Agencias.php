<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Agencias extends CI_Controller {

  private $limite = 10;
  function __construct() {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->model('agencias_models');
    $this->load->library('pagination');
  }

   public function index() {
  
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $this->load->view('agencias/registro_viewer', $data);
    }


  public function buscar() {
    $nombre = $this->input->get('idAgencias');
    $data['query'] =$this->agencias_models->buscar($nombre);           
    $datam['acceso'] = $this->session->userdata('acceso');
    $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
    $this->load->view('agencias/editar_viewer', $data);



  }


  public function actualizar() {

    $nombre = $this->input->get('idAgencias');

     $data = array(
      'nombre_agencia' => $this->input->get('nombre_agencia'),
      'descripcion' => $this->input->get('descripcion'),
      'estado' => $this->input->get('estado'));
    $this->agencias_models->update($nombre,$data);

    redirect('agencias/mostrar', 'refresh');

  }


  public function eliminar() {
    $nombre = $this->input->get('idAgencias');

    $this->agencias_models->delete($nombre);
    redirect('agencias/mostrar', 'refresh');

  }


  public function registro() {

    $data = array(
      'nombre_agencia' => $this->input->get('nombre_agencia'),
      'descripcion' => $this->input->get('descripcion'),
      'estado' => $this->input->get('estado'));

    $this->agencias_models->insertar($data);
    redirect('agencias/mostrar', 'refresh');
  }

  public function mostrar() {



    $offset =$this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
      $offset = 0;
    }



    $nombre_agencia= $this->input->get('nombre_agencia');
    $descripcion= $this->input->get('descripcion');
    



    $data['agencias'] = $this->agencias_models->getmostrar($nombre_agencia,$descripcion,$offset, $this->limite);



    $config['base_url'] = base_url() . 'agencias/mostrar?nombre_agencia='.$nombre_agencia.'&descripcion='.$descripcion; 
    $config['total_rows'] = $this->agencias_models->getmostrarCount($nombre_agencia,$descripcion);
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

        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $this->load->view('agencias/lista_viewer', $data);


      }

     


    }

    /* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */