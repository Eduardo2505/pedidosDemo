<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    private $limite = 10;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('tiket_models');
        $this->load->model('salida_models');
        $datoiniciar = $this->session->userdata('nombre');
        $this->load->library('pagination');
        $acesso = $this->session->userdata('acceso');
        $this->load->helper('cookie');
        $this->load->model('existencias_models');
        $this->load->model('pedidos_models');
        if (strlen($datoiniciar) == 0) {

            $data['cadena'] = "inicio";
            redirect('', 'refresh');
        } else if ($acesso == 1) {
            redirect('entradas', 'refresh');
        } else {
            $valor = $this->tiket_models->buscartiket($this->session->userdata('idAgencias'), 2);
            if ($valor == -1) {
                $data = array(
                    'folio' => $this->session->userdata('idAgencias'),
                    'estado' => "temporal",
                    'tipo' => 2,
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
        redirect('pedidos/iniciar', 'refresh');

    }
    public function iniciar() {


        $this->load->model('productos_models');

        $data['entradas'] = $this->salida_models->getEntradas($GLOBALS['idTiket']);
        //$data['productos'] = $this->productos_models->getBuscar("");


        $offset =$this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }



        $producto = $this->input->get('producto');


        $data['productos'] = $this->productos_models->getBuscar($producto,$offset, $this->limite);



        $config['base_url'] = base_url() . 'pedidos/iniciar?producto='.$producto ; 
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

        $data['limi'] = $this->config->item('tiempo_pedido');
        
        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $data['tiempopedido'] = "inicio";



        $this->load->view('pedidos/entradas_viewer', $data);
    }

    public function set() {

        $minutos = $this->config->item('tiempo_pedido');
        $time = $minutos * 60;
        setcookie("tiempo_pedido", "Pedido", time() + $time);
        redirect('pedidos', 'refresh');
    }

    public function get() {

        if (isset($_COOKIE["tiempo_pedido"]) == false) {
//            $idsalida = $GLOBALS['idTiket'];
//            $salidas = $this->salida_models->getEntradas($idsalida);
//            $idAgencia = 41;
//            $this->pedidos_models->limpiar($salidas, $idAgencia, $idsalida);
            echo 'se_limpio_el_pedido';
        }
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

        $data['tiketEntradas'] = $this->tiket_models->getmostrarbuscar($this->session->userdata('idAgencias'), 2, $producto, $descrip, $folio, $fechi, $fechf, $offset, $this->limite);



        $config['base_url'] = base_url() . 'pedidos/buscar?usuario=' . $producto . '&descrip=' . $descrip . '&folio=' . $folio . '&fechi=' . $fechi . '&fechf=' . $fechf; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarcountbuscar($this->session->userdata('idAgencias'), 2, $producto, $descrip, $folio, $fechi, $fechf);
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
        $data['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $this->load->view('pedidos/entradas_lista_viewer', $data);
    }

    public function mostrar() {
        //

        $uri_segment = 3;

        $offset = $this->uri->segment($uri_segment);

        if ($offset == "") {
            $offset = 0;
        }




        $data['tiketEntradas'] = $this->tiket_models->getmostrar($this->session->userdata('idAgencias'), 2, $offset, $this->limite);



        $config['base_url'] = base_url() . 'pedidos/mostrar'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarcount($this->session->userdata('idAgencias'), 2);
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
        $datam['acceso'] = $this->session->userdata('acceso');

        $this->load->view('pedidos/entradas_lista_viewer', $data);
    }

    public function agregar() {

        $idproducto = $this->input->get('idProducto');


        $total = $this->salida_models->bucarProductocantidad($GLOBALS['idTiket'], $idproducto);

        if ($total == -1) {
            $datax = array(
                'cantidad' => 1,
                'idTiket' => $GLOBALS['idTiket'],
                'idProductos' => $idproducto);
            $this->pedidos_models->insertarSal($datax);
        } else {
            $identrada = $total[0];
            $cantidad = $total[1];
            $datay = array(
                'cantidad' => $cantidad + 1);
            $this->pedidos_models->updateSal($identrada, $datay);
        }






        $data['error'] = "";


        $data['entradas'] = $this->salida_models->getEntradas($GLOBALS['idTiket']);
        $this->load->view('pedidos/aux_entradas_add', $data);
    }

    public function eliminar() {

        $idsa = $this->input->get('identrada');
        $this->pedidos_models->eliminarSal($this->input->get('identrada'));


        echo $idsa;
    }

    public function editar() {

        $cantidad = $this->input->get('cantidad');

        
        $datay = array(
            'cantidad' => $cantidad);
        $this->pedidos_models->updateSal($this->input->get('inputeditar'), $datay);

        echo $cantidad;





        //redirect('pedidos', 'refresh');
    }

    public function mas() {


        $total = $this->salida_models->bucarProductocantidad($GLOBALS['idTiket'], $this->input->get('idproducto'));

        $identrada = $total[0];
        $cantidad = $total[1] + 1;

        $datay = array(
            'cantidad' => $cantidad);
        $this->pedidos_models->updateSal($identrada, $datay);
        echo $cantidad;
    }

    public function menos() {
        $total = $this->salida_models->bucarProductocantidad($GLOBALS['idTiket'], $this->input->get('idproducto'));

        $identrada = $total[0];
        $cantidad = $total[1] - 1;
        if ($cantidad == 0) {

            $this->pedidos_models->eliminarSal($identrada);
            echo "error";
        } else {
            $datay = array(
                'cantidad' => $cantidad);
            $this->pedidos_models->updateSal($identrada, $datay);
            echo $cantidad;
        }
    }

    public function buscarProducto() {


        $this->load->model('productos_models');
        $data['productos'] = $this->productos_models->getBuscar($this->input->get('string'));
        $this->load->view('pedidos/aux_busqueda_entradas', $data);
    }

    public function verproductos() {



        $data['entradas'] = $this->salida_models->getEntradas($this->input->get('idtiket'));
        $this->load->view('pedidos/aux_tiket_reimprimir', $data);
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
                'estado' => "PEDIENTE",
                'folio' => 0,
                'idAgencias' => $idAgencia,
                'idAgencias_pedido' => 41, //Este es el ID de la suscursal principal
                'idUsuario' => $this->session->userdata('idUsuario'),
                'registro_update' => $fecha,
                'registro_inicial' => $fecha);
            $foliog = $this->tiket_models->folio($idAgencia, 2) + 1;
            $dataf = array(
                'folio' => $foliog);

            $entradasx = $this->salida_models->getEntradas($GLOBALS['idTiket']);
           
            $this->tiket_models->imprimirtiketsalida($GLOBALS['idTiket'], $datay, $dataf);


            $email =$this->session->userdata('descripcion');
           
            redirect($this->config->item('urlEmail').'idTiket='.$GLOBALS['idTiket'].'&email='.$email.'&folio='.$foliog.'&idAgencias='.$idAgencia, 'refresh');


        } else {
            redirect('pedidos', 'refresh');
        }
    }

// esta funcion es la funcion la cual interactura entre existencoas y salidas 
    public function imprimirRecupera() {

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Mexico_City'));
        $descrip = $this->input->g('idTiket');


        if (!strlen($descrip) == 0) {
            $idAgencia = $this->session->userdata('idAgencias');
            $fecha = $date->format('Y-m-d H:i:s');
            $datay = array(
                'descripcion' => $descrip,
                'estado' => "PEDIENTE",
                'folio' => 0,
                'idAgencias' => $idAgencia,
                'idAgencias_pedido' => 41, //Este es el ID de la suscursal principal
                'idUsuario' => $this->session->userdata('idUsuario'),
                'registro_update' => $fecha,
                'registro_inicial' => $fecha);
            $foliog = $this->tiket_models->folio($idAgencia, 2) + 1;
            $dataf = array(
                'folio' => $foliog);

            $entradasx = $this->salida_models->getEntradas($GLOBALS['idTiket']);
            $data['entradas'] = $entradasx;
            $data['des'] = $descrip;
            $data['agencia'] = $this->session->userdata('nombre_agencia');
            $data['fecha'] = $fecha;
            $data['fechaac'] = $fecha;
            $data['folio'] = str_pad($foliog, 5, "0", STR_PAD_LEFT);
            $data['nombre'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $data['btnsalir'] = '<a href="' . site_url('') . 'pedidos/mostrar" style="color: #333">SALIR</a>';
            $data['email'] = 'impresion';
            $this->tiket_models->imprimirtiketsalida($GLOBALS['idTiket'], $datay, $dataf, $entradasx, $fecha, $idAgencia);
            $this->load->view('pedidos/email_viewer', $data);


           
        } else {
            redirect('pedidos', 'refresh');
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

        $data['entradas'] = $this->salida_models->getEntradas($idtiket);
        $data['des'] = $row->descripcion;
        $data['agencia'] = $row->nombre_agencia;
        $data['fecha'] = $row->registro_inicial;
        $data['fechaac'] = $row->registro_update;
        $data['folio'] = str_pad($row->folio, 5, "0", STR_PAD_LEFT);
        $data['nombre'] = $row->usuario . ' ' . $row->primer_apellido;
        $data['btnsalir'] = '<a href="' . site_url('') . 'pedidos/mostrar" style="color: #333">SALIR</a>';
        $data['email'] = 'impresion';
        $data['tipo'] = 'reimpresion';
        $this->load->view('pedidos/email_viewer', $data);
        //enviar correo
    }

    function getemail($folio, $html) {
        $email = $this->session->userdata('email');

        $asunto = "Entrada FOLIO " . str_pad($folio, 5, "0", STR_PAD_LEFT) . "";
        $cabeceras = 'From: pedido@helpmex.com.mx' . "\r\n" .
        'Reply-To: pedido@helpmex.com.mx' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (@mail($email, $asunto, $html, $cabeceras)) {
            //echo "ni madres";
        } else {
            //echo "ni madres";
        }


        //echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>".$html;
    }

    function adminfolio($folio, $html) {
        $email = $this->session->userdata('descripcion');

        $asunto = "Entrada FOLIO " . str_pad($folio, 5, "0", STR_PAD_LEFT) . "";
        $cabeceras = 'From: pedidoadmin@helpmex.com.mx' . "\r\n" .
        'Reply-To: pedidoadmin@helpmex.com.mx' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (@mail($email, $asunto, $html, $cabeceras)) {
            //echo "ni madres";
        } else {
            //echo "ni madres";
        }


        //echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>".$html;
    }

    

// subir archivos


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */