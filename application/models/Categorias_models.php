<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

   function get() {

       
        $query = $this->db->get('categorias');

        return $query;
    }

}