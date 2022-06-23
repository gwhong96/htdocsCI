<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model(array('test_model', 'board'));
    }

    public function index() {

        $this->load->model('test_model');// test_model의 return 값으로 2차원 배열을 받아왔음
        $aPraram['memberId'] = 1;
        $aPraram['boarId'] = 2;
        $data_result = $this->test_model->test($aPraram);//그 값을 result배열의 data인덱스에 저장?

        //$result = array('a'=>1,'b'=>2);

        // $this->load->view('test_view');
        $memberInfo['data'] = $data_result;

        $this->load->view('head');
        $this->load->view('signIn',$memberInfo);//main 에서 memberInfo의 데이터를 $data로 사용할 수 있음
        $this->load->view('foot');

    }

    public function adb($board_id = 0){

      echo "<pre>";
      var_dump(array('s'=>1));
      print_r(array('s'=>1));


      echo $this->input->get('boardID');
      echo 'board => '.$board_id;
    }
    // public function list($boardID = 0){
    //   $this->load->model('test_model');
    //   $aParam['test_id'] = 1;
    //   $result = $this->test_model->test($aParam);
    //   var_dump($result);
    //   $this->load->view('index');
    // }
}
