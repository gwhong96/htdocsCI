<?php defined('BASEPATH') OR exit('No direct script access allowed');

// board테이블 모델
class Board_model extends CI_Model {

    function __construct(){
        parent::__construct();
        //database.php 파일에서 $test(database이름)['test(table이름)'] 설정값 load
        $this->load->database();
    }

    function signIn($signInfo) {//로그인 확인용
      if(!isset($signInfo['userEmail'],$signInfo['userPW'])){
        return array();
      }
      $sql = "SELECT email, nickName, memberID FROM member ";
      $sql .= "WHERE email = '{$signInfo['userEmail']}' AND memberPW = '{$signInfo['userPW']}'";
      $result =  $this->db-> query($sql);

      $memberInfo = $result -> result_array();
      return $memberInfo;
    }

    public function getList($param, $type){//리스트 불러오기
      if(isset($param['page'])){
        $page = (int) $param['page'];
        }else{
          $page = 1;
        }
        $numView = 10;//페이지별 노출 게시글 수

        $firstLimitValue = ($numView * $page) - $numView;

      $sql  = "SELECT boardID, title, m.nickName, b.regTime, b.views, b.disYN FROM board b JOIN member m ";
      $sql .= "ON (b.memberID = m.memberID) ";

      $sqlCount = "SELECT count(boardID) AS board_cnt FROM board b JOIN member m ";
      $sqlCount .= "ON (b.memberID = m.memberID) ";

      if(isset($param['searchOption'])){$searchOption = $param['searchOption'];}

      if(isset($param['searchKeyword'])){
        $searchKeyword = $param['searchKeyword'];
        switch($searchOption){//검색 옵션별 where 쿼리
          case 'title':
          $sql_param = "WHERE title LIKE '%{$searchKeyword}%'";// 키워드가 속한 모든 내용
          break;
          case 'content':
          $sql_param = "WHERE b.content LIKE '%{$searchKeyword}%'";
          break;
          case 'writer':
          $sql_param = "WHERE m.nickName LIKE '%{$searchKeyword}%'";//작성자 검색
          break;
          case 'torc':
          $sql_param = "WHERE b.title LIKE '%{$searchKeyword}%' OR b.content LIKE '%{$searchKeyword}%'";
          break;
        }
        $sqlCount .= $sql_param." AND b.delYN = 'N' ";
        $sql .= $sql_param." AND b.delYN = 'N' ";
        }else{
          $sql .= "WHERE b.delYN = 'N' ";
          $sqlCount .= "WHERE b.delYN = 'N' ";
        }
        $sql .= "ORDER BY boardID ";
        $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";

      $result = $this -> db -> query($sql);
      $result_count = $this->db->query($sqlCount);

      if($type == 'list'){
          $boardInfo = $result-> result_array();
      }else{
          $boardInfo = $result_count -> result_array();
      }
      return $boardInfo;
    }

    function list($page,$searchKeyword,$searchOption){//리스트 출력을 위한 데이터 쿼리

    }

    function member() {//member 테이블

        $sql = "SELECT * FROM member ";
        $result =  $this->db-> query($sql);

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
}
?>
