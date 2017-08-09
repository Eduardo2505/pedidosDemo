<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Productos extends CI_Controller {

  private $limite = 10;
  function __construct() {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->model('productos_models');
    $this->load->library('pagination');
  }

  public function captura() {

    $mens=4;

    if(!empty ($this->input->get('op'))){

      $mens = $this->input->get('op');
    }

    $datam['acceso'] = $this->session->userdata('acceso');
    $this->load->model('categorias_models');
    $data['categorias'] =$this->categorias_models->get();           
    $data['msn'] =$mens;
    $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
    $this->load->view('productos/registro_viewer', $data);


  }


  public function buscar() {

    $nombre = $this->input->get('idProductos');
    $mens=4;

    if(!empty ($this->input->get('op'))){

      $mens = $this->input->get('op');
    }
    $this->load->model('categorias_models');
    $data['query'] =$this->productos_models->buscar($nombre);  
    $data['categorias'] =$this->categorias_models->get();           
    $datam['acceso'] = $this->session->userdata('acceso');
    $data['msn'] =$mens;
    $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
    $this->load->view('productos/editar_viewer', $data);



  }


  public function actualizar() {

    $nombre = $this->input->get('idProductos');

    $data = array(
      'nombre' => $this->input->get('nombre'),
      'descripcion' => $this->input->get('descripcion'),
      'talla' => $this->input->get('talla'),
      'idUsuario' => 3,
      'idCategorias' => $this->input->get('idCategorias'),
      'estado' => $this->input->get('estado'));

    $this->productos_models->update($nombre,$data);

    redirect('productos/mostrar', 'refresh');

  }


  public function eliminar() {
    $nombre = $this->input->get('idProductos');

    $this->productos_models->delete($nombre);
    redirect('productos/mostrar', 'refresh');

  }


  public function registro() {

    $data = array(
      'nombre' => $this->input->get('nombre'),
      'descripcion' => $this->input->get('descripcion'),
      'talla' => $this->input->get('talla'),
      'idUsuario' => 3,
      'idCategorias' => $this->input->get('idCategorias'),
      'estado' => $this->input->get('estado'));

    $this->productos_models->insertar($data);
    redirect('productos/mostrar', 'refresh');
  }

  public function mostrar() {



    $offset =$this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
      $offset = 0;
    }



    $producto= $this->input->get('producto');
    $talla= $this->input->get('talla');
    $categoria= $this->input->get('categoria');




    $data['productos'] = $this->productos_models->mostrar($producto,$talla,$categoria,$offset, $this->limite);



    $config['base_url'] = base_url() . 'productos/mostrar?producto='.$producto.'&talla='.$talla.'&categoria='.$categoria; 
    $config['total_rows'] = $this->productos_models->mostrarcount($producto,$talla,$categoria);
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
        $this->load->view('productos/lista_viewer', $data);


      }

      public function editarProducto() {

        $path = $this->config->item('clusters');

        $this->load->library('upload');
        if (isset($_POST['submit']))
        {
        // Cargamos la libreria Upload

          $nombre=$this->input->post('idProductos');
          $urlArchivo=$this->input->post('url');

          if (!empty($_FILES['userfile']['name']))
          {

            // Subimos archivo 1
            if($_FILES['userfile']['type']=="image/jpeg"||$_FILES['userfile']['type']=="image/png"||$_FILES['userfile']['type']=="image/gif"){ 

            //=============================
             $file = $path.$urlArchivo;


             if (file_exists($file)) {
              $do = unlink($file);
            }

            $fichero_subido = $path."productos/". basename($nombre.".jpg");


            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido)) {

              $source_path = $path . "productos/".$nombre.".jpg";
              $target_path = $path . 'productos/';

              $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 200,
                'height' => 200
                );
              $this->load->library('image_lib', $config_manip);
              if (!$this->image_lib->resize()) {

               echo $this->image_lib->display_errors();

             }
    // clear //
             $this->image_lib->clear();


             $do = unlink($source_path);

             if($do != true){
               echo "Se elimino";
             }
             $urlv = "productos/".$nombre."_thumb.jpg";

             $data = array(
              'nombre' => $this->input->post('nombre'),
              'descripcion' => '-',
              'talla' => $this->input->post('talla'),
              'idUsuario' => $this->session->userdata('idUsuario'),
              'url'=>$urlv,
              'registro'=> date("Y-m-d H:i:s"), 
              'idCategorias' => $this->input->post('idCategorias'),
              'estado' => $this->input->post('estado'));
             $nombre = $this->input->post('idProductos');


             $this->productos_models->update($nombre,$data);

             redirect('productos/mostrar', 'refresh');

           }

         }
         else
         {
                //echo $this->upload->display_errors();
          redirect('productos/buscar?idProductos='.$this->input->post('idProductos').'&op=1', 'refresh');
        }

      }else{

       $data = array(
        'nombre' => $this->input->post('nombre'),
        'descripcion' => '-',
        'talla' => $this->input->post('talla'),
        'idUsuario' => $this->session->userdata('idUsuario'),
        'registro'=> date("Y-m-d H:i:s"),           
        'idCategorias' => $this->input->post('idCategorias'),
        'estado' => $this->input->post('estado'));

       $nombre = $this->input->post('idProductos');
       $this->productos_models->update($nombre,$data);

       redirect('productos/mostrar', 'refresh');

     }

       // echo  "HIAS";
   }
   else
   {
    redirect('productos/mostrar', 'refresh');
  }




}


public function registrarProducto() {

  $path = $this->config->item('clusters');

  if (isset($_POST['submit']))
  {
        // Cargamos la libreria Upload


    if (!empty($_FILES['userfile']['name']))
    {

            // Subimos archivo 1
     if($_FILES['userfile']['type']=="image/jpeg"||$_FILES['userfile']['type']=="image/png"||$_FILES['userfile']['type']=="image/gif"){ 


       $data = array(
        'nombre' => $this->input->post('nombre'),
        'descripcion' => '-',
        'talla' => $this->input->post('talla'),
        'idUsuario' => $this->session->userdata('idUsuario'),
        'registro'=> date("Y-m-d H:i:s"), 
        'idCategorias' => $this->input->post('idCategorias'),
        'estado' => $this->input->post('estado'));

       $id=$this->productos_models->insertar($data);

       $fichero_subido = $path."productos/". basename($id.".jpg");
       if (move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido)) {


        $source_path = $path . "productos/".$id.".jpg";
        $target_path = $path . 'productos/';

        $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 200,
          'height' => 200
          );
        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {

         echo $this->image_lib->display_errors();

       }
    // clear //
       $this->image_lib->clear();

       
       $do = unlink($source_path);

       if($do != true){
         echo "Se elimino";
       }
       $urlv = "productos/".$id."_thumb.jpg";
       $datap = array(
        'url'=>$urlv);
       $this->productos_models->update($id,$datap);


       redirect('productos/mostrar', 'refresh');
     }



   }
   else
   {
                //echo $this->upload->display_errors();
    redirect('productos/captura?op=1', 'refresh');
  }

}else{

 $data = array(
  'nombre' => $this->input->post('nombre'),
  'descripcion' => '-',
  'talla' => $this->input->post('talla'),
  'idUsuario' => $this->session->userdata('idUsuario'),
  'url'=>'productos/dmitry_s.jpg',
  'registro'=> date("Y-m-d H:i:s"),           
  'idCategorias' => $this->input->post('idCategorias'),
  'estado' => $this->input->post('estado'));

 $this->productos_models->insertar($data);

 redirect('productos/mostrar', 'refresh');

}

       // echo  "HIAS";
}
else
{
  redirect('productos/mostrar', 'refresh');
}




}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */