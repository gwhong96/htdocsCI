<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model(array('test_model', 'board'));
        $this->load->model('board_model');
        // $this->load->library("pagination");
    }

    public function index() {//로그인 페이지
      $this -> load -> view('signInForm');
    }

    public function signIn(){//로그인 확인
      $this->load->model('Board_model');

      $signInfo['userEmail'] = $this->input->post("userEmail");
      $signInfo['userPW'] = $this->input->post("userPW");

      // $signInfo['userPW'] = hash('sha256', 'nasmedia'.$signInfo['userPW']);//회원정보와 비교를 위한 해시 암호화

      $aResult = $this-> Board_model->signIn($signInfo);

      if(count($aResult)> 0) {

        $_SESSION['memberID'] = $aResult[0]['memberID'];
        $_SESSION['nickName'] = $aResult[0]['nickName'];

        $array['result'] = true;
        echo $_SESSION['memberID'];
        echo '&nbsp';
        echo $_SESSION['nickName'];
      } else {
        $array['result'] = false;
      }
      return json_encode($array);//ajax 호출하고 controller에서 json 리턴할 때 return json_encode($array);
    }

    public function _remap($method){//페이지별 헤더 푸터 추가
      $this->load->view('head');
      if(method_exists($this,$method)){
        $this->{"{$method}"}();
      }
      $this->load->view('foot');
    }

    public function list_board(){//리스트 페이지

      $param['page'] = $this->input->get('page', 1);
      $aResult = $this->getList($param);//getList()가 모델으로부터 가져온 리턴값 뺏어오기
      $this -> load -> view('list_view',$aResult);//리스트 본문
      // echo $this->pagination->create_links();//pagination 라이브러리 호출
      // $this -> load -> view('search');//검색 폼
    }

    public function getList($param){

      $getParam['page'] = $this -> input ->get('page');
      if(isset($_GET['searchKeyword'])){
        $getParam['searchKeyword'] = $this -> input ->get('searchKeyword');
        $getParam['searchOption'] = $this -> input ->get('searchOption');
      }

      $this -> load -> model('board_model');
      $this->load->library('pagination');

      $result['list'] = $this->board_model->getList($getParam, 'list');
      $result['count'] = $this->board_model->getList($getParam, 'count');

      // $config['base_url'] = 'http://nasboard.com/board/list_board';
      $config['base_url'] = base_url(). "board/list_board";
      $config['first_url'] = base_url()."board/list_board?page=1";
      $config['num_links'] = 2;//현재페이지 기준 좌우 2개씩 총 5개
      $config['total_rows'] = $result['count'][0]['board_cnt'];
      $config['per_page'] = 10;
      $config['page_query_string'] = TRUE;
      $config['use_page_numbers']=TRUE;
      $config['query_string_segment'] = 'page';
      $config['last_link'] = 'Last';
      // $config['enable_query_strings']=TRUE;

      $this->pagination->initialize($config);

      $result['paging'] = $this->pagination->create_links();

      return $result;
    }

    public function signUp(){//회원가입 페이지
      $this->load->model('test_model');// test_model의 member function의 리턴 값으로 2차원 배열을 받아왔음
      $aParam['memberID'] = $this->post('memberID');
      $aParam['boarID'] = 2;

      $data_result = $this->member(memberID,boarID);//그 값을 result배열의 data인덱스에 저장?
      $memberInfo['data'] = $data_result;//받아온 배열 형태의 데이터를 $data에 삽입해서 view에서 사용

      echo '<br>';

      $this->load->view('head');
      $this->load->view('signUpForm',$memberInfo);
      $this->load->view('foot');

    }

}
