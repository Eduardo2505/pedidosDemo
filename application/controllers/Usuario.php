<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    private $limite = 10;
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('usuario_models');
        $this->load->library('pagination');
    }

    public function index() {
        $this->load->model('agencias_models');
        $data['agencias'] = $this->agencias_models->get();        
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $this->load->view('usuario/registro_lista_viewer', $data);
    }


    public function buscar() {
      $nombre = $this->input->get('idusuario');

      $data['query'] =$this->usuario_models->buscar($nombre);

      $this->load->model('agencias_models');
      $data['agencias'] = $this->agencias_models->get();        
      $datam['acceso'] = $this->session->userdata('acceso');
      $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
      $this->load->view('usuario/editar_viewer', $data);


      
  }


  public function actualizar() {

      $nombre = $this->input->get('idusuario');

      $data = array(
        'nombre' => $this->input->get('nombre'),
        'primer_apellido' => $this->input->get('apellido'),
        'email' => $this->input->get('email'),
        'contrasena' => $this->input->get('contrasena'),
        'acceso' => 2,
        'estado' => 1,
        'idAgencias' => $this->input->get('idagencia'));
      $this->usuario_models->update($nombre,$data);

      redirect('usuario/mostrar', 'refresh');

  }


  public function eliminar() {
      $nombre = $this->input->get('idusuario');

      $this->usuario_models->delete($nombre);
      redirect('usuario/mostrar', 'refresh');

  }


  public function registro() {

    $data = array(
        'nombre' => $this->input->get('nombre'),
        'primer_apellido' => $this->input->get('apellido'),
        'email' => $this->input->get('email'),
        'contrasena' => $this->input->get('contrasena'),
        'acceso' => 2,
        'estado' => 1,
        'idAgencias' => $this->input->get('idagencia'));

    $this->usuario_models->insertar($data);
    redirect('usuario', 'refresh');
}

public function mostrar() {



    $offset =$this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }



    $nombre = $this->input->get('nombre');
    $apellido = $this->input->get('apellido');
    $email = $this->input->get('email');
    $agencia = $this->input->get('agencia');




    $data['usuarios'] = $this->usuario_models->getmostrar($nombre,$apellido, $email,$agencia,$offset, $this->limite);



    $config['base_url'] = base_url() . 'usuario/mostrar?nombre='.$nombre.'&apellido='.$apellido.'&email='.$email.'&agencia='.$agencia; 
    $config['total_rows'] = $this->usuario_models->getmostrarCount($nombre,$apellido, $email,$agencia);
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
        $this->load->view('usuario/usuarios_lista_viewer', $data);


    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */