<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        //header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');


        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $datoiniciar = $this->session->userdata('nombre');
        if (strlen($datoiniciar) != 0) {


            redirect('entradas/iniciar', 'refresh');
        }
    }

    public function index() {
        //$user_agent = $_SERVER['HTTP_USER_AGENT'];
        //$navegador = $this->getBrowser($user_agent);
        $data['cadena'] = "inicio";
        $data['navegador'] ='permitido'; //$navegador;
        $this->load->view('welcome_message', $data);
    }

    function getBrowser($user_agent){

        if(strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
             elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
             return 'MicrosoftEdge';
             elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
             return 'Internetexplorer';
             elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
                return "OperaMini";
            elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
             return "Opera";
         elseif(strpos($user_agent, 'Firefox') !== FALSE)
             return 'permitido';
         elseif(strpos($user_agent, 'Chrome') !== FALSE)
             return 'permitido';
         elseif(strpos($user_agent, 'Safari') !== FALSE)
             return "Safari";
         else
             return 'No hemos podido detectar su navegador';


     }

     public function login() {
        $this->load->model('usuario_models');
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $valor = $this->usuario_models->login($email, $pass);

        if ($valor->num_rows() != 0) {
            $row = $valor->row();

            $newdata = array(
                'idUsuario' => $row->idUsuario,
                'nombre' => $row->nombre,
                'primer_apellido' => $row->primer_apellido,
                'email' => $row->email,
                'contrasena' => $row->contrasena,
                'acceso' => $row->acceso,
                'estado' => $row->estado,
                'registro' => $row->registro,
                'nombre_agencia' => $row->nombre_agencia,
                'descripcion' => $row->descripcion,
                'idAgencias' => $row->idAgencias
                );

            $this->session->set_userdata($newdata);


            //echo "Este es el iD de Session :".session_id();

            $datoiniciar = $this->session->userdata('nombre');

           // echo  "<br>este es el usuario ". $datoiniciar;

            $acceso = $row->acceso;
            if ($acceso == 1) {
               redirect('entradas/iniciar', 'refresh');
           }if($acceso == 2||$acceso == 3){
            redirect('pedidos/iniciar', 'refresh');
        }
    } else {
        $data['cadena'] = "error";
       // $user_agent = $_SERVER['HTTP_USER_AGENT'];
        //$navegador = $this->getBrowser($user_agent);
        $data['navegador'] ='permitido';// $navegador;
        $this->load->view('welcome_message', $data);


    }
}

public function salir() {

    $this->session->sess_destroy();
    redirect('', 'refresh');
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */