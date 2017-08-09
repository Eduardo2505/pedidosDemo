<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidosadmin extends CI_Controller {

    private $limite = 10;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('tiket_models');
        $datoiniciar = $this->session->userdata('nombre');
        $this->load->library('pagination');
        $this->load->model('salida_models');
        $acesso = $this->session->userdata('acceso');
        if (strlen($datoiniciar) == 0) {

            $data['cadena'] = "inicio";
            redirect('', 'refresh');
        } 
    }

    public function buscar() {
        //



        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }


        $sucursal = $this->input->get('sucursal');
        $producto = "";
        $descrip = $this->input->get('descrip');
        $folio = $this->input->get('folio');
        $fechi = $this->input->get('fechi');
        $fechf = $this->input->get('fechf');

        $data['tiketEntradas'] = $this->tiket_models->getmostrarbuscarpedidos($sucursal, $producto, $descrip, $folio, $fechi, $fechf, $offset, $this->limite);



        $config['base_url'] = base_url() . 'pedidosadmin/buscar?sucursal=' . $sucursal . '&usuario=' . $producto . '&descrip=' . $descrip . '&folio=' . $folio . '&fechi=' . $fechi . '&fechf=' . $fechf; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarbuscarpedidoscout($sucursal, $producto, $descrip, $folio, $fechi, $fechf);
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
        $this->load->view('inventario/adminentradas_lista_viewer', $data);
    }

    public function index() {


        $uri_segment = 3;

        $offset = $this->uri->segment($uri_segment);

        if ($offset == "") {
            $offset = 0;
        }



        $data['tiketEntradas'] = $this->tiket_models->getmostrarbuscarpedidos("", "", "", "", "", "", $offset, $this->limite);



        $config['base_url'] = base_url() . 'pedidosadmin/buscar?sucursal=&usuario=&descrip=&folio=&fechi=&fechf='; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->tiket_models->getmostrarbuscarpedidoscout("", "", "", "", "", "");
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
        $datam['acceso'] = $this->session->userdata('acceso');

        $this->load->view('inventario/adminentradas_lista_viewer', $data);
    }

    public function verproductos() {



        $data['entradas'] = $this->salida_models->getEntradas($this->input->get('idtiket'));
        $this->load->view('pedidos/aux_tiket_reimprimir', $data);
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
        $data['btnsalir'] = '<a href="' . site_url('') . 'pedidosadmin" style="color: #333">SALIR</a>';
        $data['email'] = 'impresion';
        $data['tipo'] = 'reimpresion';
        $this->load->view('pedidos/email_viewer', $data);
        //enviar correo
    }

    public function imprimirRecupera() {


        $idTiket = $this->input->get('idTiket');


        $datay = array(
            'estado' => "ACEPTADO",
            'useraceptado' => $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido'));


        $entradasx = $this->salida_models->getEntradas($idTiket);
        $tikets = $this->tiket_models->buscar($idTiket);
        $row = $tikets->row();
        $data['entradas'] = $entradasx;
        $data['des'] = $row->descripcion;
        $data['agencia'] = $row->nombre_agencia;
        $data['fecha'] = $row->registro_inicial;
        $data['fechaac'] = $row->registro_update;
        $data['folio'] = $row->folio;
        $data['nombre'] = $row->usuario . ' ' . $row->primer_apellido;
        $data['btnsalir'] = '<a href="' . site_url('') . 'pedidosadmin" style="color: #333">SALIR</a>';
        $data['email'] = 'impresion';
        $data['tipo'] = 'original';
        $this->tiket_models->imprimirtiketAceptar($idTiket, $datay, $entradasx, 41);
        $this->load->view('pedidos/email_viewer', $data);

       /* $data['email'] = 'email';
        $htmlx = $this->load->view('pedidos/email_viewer', $data, true);
        $this->getemail($row->folio, $htmlx);*/
    }

    function getemail($folio, $html) {
        $email = $this->session->userdata('email');

        $asunto = "Entrada FOLIO " . str_pad($folio, 5, "0", STR_PAD_LEFT) . "";
        $cabeceras = 'From: pedido@helpmex.com.mx' . "\r\n" .
        'Reply-To: pedido@helpmex.com.mx' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (mail($email, $asunto, $html, $cabeceras)) {
            //echo "ni madres";
        } else {
            //echo "ni madres";
        }


        //echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>".$html;
    }

    public function guia() {

        $datam['acceso'] = $this->session->userdata('acceso');
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $this->load->view('pedidos/guia', $data);
    }



    public function subirNota() {

        $path = $this->config->item('clusters');

        $idTiket = $this->input->post('idTiket');
        $folio = $this->input->post('folio');

        if (isset($_POST['submit']))
        {

         if (!empty($_FILES['userfile']['name']))
         {


          

          if($_FILES['userfile']['type']=="application/pdf"){ 

            $file2 =$path."notas/".$idTiket;


            if (is_dir($file2)) {

                $file = $path."notas/".$idTiket."/nota_".$idTiket.".pdf";
                $do = unlink($file);

            }else{
             mkdir($file2, 0777, true);
         }

         $fichero_subido = $file2."/". basename("nota_".$idTiket.".pdf");


         if (move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido)) {

           $data = array(
            'urlArchivo' => 'notas/'.$idTiket.'/nota_'.$idTiket.'.pdf');
           $this->tiket_models->update($idTiket, $data);

           redirect('pedidosadmin/buscar?sucursal=&descrip=&folio='.$folio.'&fechi=&fechf=','refresh');

       }

}else {
           redirect('pedidosadmin/cargarEvidencia?op=1&idTiket='.$idTiket,'refresh');
    }

}else{

 redirect('pedidosadmin/cargarEvidencia?op=2&idTiket='.$idTiket,'refresh');
}

       // echo  "HIAS";
}
else
{
 redirect('pedidosadmin/buscar?sucursal=&descrip=&folio='.$folio.'&fechi=&fechf=','refresh');

}




}


public function cargarEvidencia() {

    $mens=4;

    if(!empty ($this->input->get('op'))){

        $mens = $this->input->get('op');
    }

    $datam['acceso'] = $this->session->userdata('acceso');
    $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
    $data['msn'] =$mens;
    $data['idTiket'] =$this->input->get('idTiket');
    $data['folio'] =$this->input->get('folio');
    $this->load->view('pedidos/guia', $data);
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */