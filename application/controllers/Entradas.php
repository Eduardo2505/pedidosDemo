<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entradas extends CI_Controller {

 private $limite = 10;

 function __construct() {

    parent::__construct();
   // header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('pagination');
    $this->load->model('tiket_models');
    $this->load->model('entradas_models');
    $this->load->library('session');
    $datoiniciar = $this->session->userdata('nombre');
    $acesso = $this->session->userdata('acceso');

    /*echo "Este es el iD de Session :".session_id();
    
    echo "<br>nombre :".$datoiniciar;
    echo "<br>acesso :".$acesso;*/
    
    if (strlen($datoiniciar) == 0) {
        $data['cadena'] = "inicio";
        redirect('', 'refresh');
    } else if ($acesso == 2||$acesso == 3) {
        redirect('pedidos', 'refresh');
    } else {
        $valor = $this->tiket_models->buscartiket($this->session->userdata('idAgencias'), 1);
        if ($valor == -1) {
            $data = array(
                'folio' => $this->session->userdata('idAgencias'),
                'estado' => "temporal",
                'tipo' => 1,
                'idUsuario' => $this->session->userdata('idUsuario'),
                'idAgencias' => $this->session->userdata('idAgencias'));
            $idt = $this->tiket_models->insertar($data);
                // echo $idt;
            $GLOBALS['idTiket'] = $idt;
        } else {
            $GLOBALS['idTiket'] = $valor;
                //  echo $valor;
        }
    }
}

public function index() {

    redirect('entradas/iniciar', 'refresh');

}

public function iniciar() {
    $this->load->model('productos_models');

    $data['entradas'] = $this->entradas_models->getEntradas($GLOBALS['idTiket']);
       // $data['productos'] = $this->productos_models->getBuscar("");

    $offset =$this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }



    $producto = $this->input->get('producto');


    $data['productos'] = $this->productos_models->getBuscar($producto,$offset, $this->limite);



    $config['base_url'] = base_url() . 'entradas/iniciar?producto='.$producto ; 
    $config['total_rows'] = $this->productos_models->count($producto);
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
        $this->load->view('entradas/entradas_viewer', $data);


    }
    public function buscar() {
        //



        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }



        $producto = $this->input->get('usuario');
        $descrip = $this->input->get('descrip');
        $folio = $this->input->get('folio');
        $fechi = $this->input->get('fechi');
        $fechf = $this->input->get('fechf');

        $data['tiketEntradas'] = $this->tiket_models->getmostrarbuscar($this->session->userdata('idAgencias'), 1, $producto, $descrip, $folio, $fechi, $fechf, $offset, $this->limite);



        $config['base_url'] = base_url() . 'entradas/buscar?usuario=' . $producto . '&descrip=' . $descrip . '&folio=' . $folio . '&fechi=' . $fechi . '&fechf=' . $fechf; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarcountbuscar($this->session->userdata('idAgencias'), 1, $producto, $descrip, $folio, $fechi, $fechf);
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
        $this->load->view('entradas/entradas_lista_viewer', $data);
    }

    public function mostrar() {
        //

        $uri_segment = 3;

        $offset = $this->uri->segment($uri_segment);

        if ($offset == "") {
            $offset = 0;
        }




        $data['tiketEntradas'] = $this->tiket_models->getmostrar($this->session->userdata('idAgencias'), 1, $offset, $this->limite);



        $config['base_url'] = base_url() . 'entradas/mostrar'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarcount($this->session->userdata('idAgencias'), 1);
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación


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
        $this->load->view('entradas/entradas_lista_viewer', $data);
    }

    public function agregar() {

        $idproducto = $this->input->get('idProducto');
        $total = $this->entradas_models->bucarProductocantidad($GLOBALS['idTiket'], $idproducto);
        //echo $total;
        if ($total == -1) {
            $datax = array(
                'cantidad' => 1,
                'idTiket' => $GLOBALS['idTiket'],
                'idProductos' => $idproducto);
            $this->entradas_models->insertar($datax);
        } else {
            $identrada = $total[0];
            $cantidad = $total[1];
            $datay = array(
                'cantidad' => $cantidad + 1);
            $this->entradas_models->update($identrada, $datay);
        }

        $data['entradas'] = $this->entradas_models->getEntradas($GLOBALS['idTiket']);
        $this->load->view('entradas/aux_entradas_add', $data);
    }


    public function eliminar() {
        $idsa = $this->input->get('identrada');
        $this->entradas_models->delete($this->input->get('identrada'));
        echo $idsa;
    }

    public function editar() {

        $cantidad = $this->input->get('cantidad');


        $datay = array(
            'cantidad' => $cantidad);
        $this->entradas_models->update($this->input->get('inputeditar'), $datay);
        echo $cantidad;
    }

    public function mas() {

        $total = $this->entradas_models->entradastotal($this->input->get('inputeditar'));
        $totalu = $total + 1;
        $datay = array(
            'cantidad' => $totalu);
        $this->entradas_models->update($this->input->get('inputeditar'), $datay);
        echo $totalu;
    }

    public function menos() {

        $total = $this->entradas_models->entradastotal($this->input->get('inputeditar'));
        $totalu = $total - 1;
        if ($totalu == 0) {
            $this->entradas_models->delete($this->input->get('inputeditar'));
            echo 'error';
        } else {
            $datay = array(
                'cantidad' => $totalu);
            $this->entradas_models->update($this->input->get('inputeditar'), $datay);
            echo $totalu;
        }
    }

    

    public function verproductos() {



        $data['entradas'] = $this->entradas_models->getEntradas($this->input->get('idtiket'));
        $this->load->view('entradas/aux_tiket_reimprimir', $data);
    }

    public function imprimir() {

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Mexico_City'));
        $descrip = $this->input->post('descripcion');

        if (!strlen($descrip) == 0) {
            $idAgencia = $this->session->userdata('idAgencias');
            $fecha = $date->format('Y-m-d H:i:s');
            $datay = array(
                'descripcion' => $descrip,
                'estado' => "ACEPTADO",
                'folio' => 0,
                'idAgencias' => $idAgencia,
                'idUsuario' => $this->session->userdata('idUsuario'),
                'registro_update' => $fecha,
                'registro_inicial' => $fecha);
            $foliog = $this->tiket_models->folio($idAgencia, 1) + 1;
            $dataf = array(
                'folio' => $foliog);

            $entradasx = $this->entradas_models->getEntradas($GLOBALS['idTiket']);
            $data['entradas'] = $entradasx;
            $data['des'] = $descrip;
            $data['agencia'] = $this->session->userdata('nombre_agencia');
            $data['fecha'] = $fecha;
            $data['fechaac'] = $fecha;
            $data['folio'] = str_pad($foliog, 5, "0", STR_PAD_LEFT);
            $data['nombre'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');


            $this->tiket_models->imprimirtiket($GLOBALS['idTiket'], $datay, $dataf, $entradasx, $fecha, $idAgencia);
            $data['btnsalir'] = '<a href="' . site_url('') . 'entradas/mostrar" style="color: #333">SALIR</a>';
            $data['email'] = 'impresion';
            $this->load->view('entradas/email_viewer', $data);


        } else {
            redirect('entradas', 'refresh');
        }
    }
    public function reimprimir() {

        $idtiket = $this->input->get('idTiket');
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Mexico_City'));
        $fecha = $date->format('Y-m-d H:i:s');
        $datay = array(
            'registro_update' => $fecha);
        $this->tiket_models->update($idtiket, $datay);


        $query = $this->tiket_models->buscar($idtiket);
        $row = $query->row();

        $data['entradas'] = $this->entradas_models->getEntradas($idtiket);
        $data['des'] = $row->descripcion;
        $data['agencia'] = $row->nombre_agencia;
        $data['fecha'] = $row->registro_inicial;
        $data['fechaac'] = $row->registro_update;
        $data['folio'] = str_pad($row->folio, 5, "0", STR_PAD_LEFT);
        $data['nombre'] = $row->usuario . ' ' . $row->primer_apellido;
        $data['btnsalir'] = '<a href="' . site_url('') . 'entradas/mostrar" style="color: #333">SALIR</a>';
        $data['email'] = 'impresion';
        $this->load->view('entradas/email_viewer', $data);
        //enviar correo
    }

    




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */