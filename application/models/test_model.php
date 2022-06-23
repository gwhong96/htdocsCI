<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Test_model extends CI_model {

    function __construct(){
        parent::__construct();
        //database.php 파일에서 $test(database이름)['test(table이름)'] 설정값 load
        $this->load->database('default', TRUE);
    }

    function member() {//member 테이블

        $sql = "SELECT * FROM member ";
        $result =  $this-> query($sql);

        $memberInfo = $result -> result_array();
        return $memberInfo;

      // if($aParam['memberId'] != '') {
      //   $swhere .= " AND member_id = {$aParam}";
      // }
      //   $sql = "SELECT * FROM member where 1 {$aParam}";
      //   $result =  $this->test-> query($sql);
      //
      //   $memberInfo = $result -> result_array();
      //   return $memberInfo;
    }

    function board() {//board 테이블
      $sql = "SELECT * FROM board; "
      $result = $this-> query($sql);

      $boardInfo = $result -> result_array();
      return $boardInfo;
    }

    // 회원 정보 수정
    // function test2() {
      // $sql= "UPdate "
    // }
}
