<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model(array('test_model', 'board'));

    }

    public function signIn() {
      $array = $this->input->post();


      $this->input->post("userPW");
      $this->input->post("userPW");
      $a = $this->input->post("userPW");
    }
  }

  ?>
