<div class="paging" style="text-align : center">

<?php

  $sql = "SELECT count(boardID) FROM board b JOIN member m ON (b.memberID = m.memberID) ";//count (pk컬럼) = 전체 row의 갯수 = 전체 게시글
  if(isset($_GET['searchKeyword'])){
    switch($searchOption){//검색 옵션별 where 쿼리
      case 'title':
        $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";// 제목 검색
        break;
      case 'content':
        $sql .= "WHERE b.content LIKE '%{$searchKeyword}%'";// 내용 검색
        break;
      case 'writer':
        $sql .= "WHERE m.nickName LIKE '%{$searchKeyword}%'";//작성자 검색
        break;
      case 'torc':
        $sql .= "WHERE b.title LIKE '%{$searchKeyword}%' OR b.content LIKE '%{$searchKeyword}%'";//제목과 내용 검색
        break;
    }}
    $sql .=" AND delYN = 'N'";

  $result = $dbConnect -> query($sql);


  $boardTotalCount = $result ->fetch_array(MYSQLI_ASSOC);//컬럼명으로 호출
  $boardTotalCount = $boardTotalCount['count(boardID)'];//전체 게시글 수

  $totalPage = ceil($boardTotalCount / $numView);//총 페이지 수 (ceil 올림)

  if(isset($searchKeyword)){
      $link =  "&searchKeyword={$searchKeyword}"."&option={$searchOption}";
    }else{
      $link =  '';
    }

  echo "<a href = './list.php?page=1{$link}'><em class='fa fa-angle-double-left' style='color:gray;'></em></a>";

  if($page != 1){
    $previousPage = $page - 1;
    echo "<a href='./list.php?page={$previousPage}{$link}'><em class='fa fa-angle-left' style='color:gray;'></em></a>";
  }//이전 페이지 이동 링크

  $pageTerm = 5;//앞뒤 페이지 표시 갯수

  $startPage = $page - $pageTerm;
  //처음에 표시되는 페이지를 현재 페이지 기준으로 정해진 갯수만큼만 표시

  if($startPage < 1){
    $startPage = 1;
  }//시작페이지가 1보다 작을경우 1로 고정

  $lastPage = $page + $pageTerm;

  if($lastPage >= $totalPage){
    $lastPage = $totalPage;
  }//마지막 페이지 표시가 실제 페이지 최대 갯수보다 많을경우

  for($i = $startPage; $i <= $lastPage; $i++){
    $style='';
    if($page==$i){
      $style="style='color:#CE181E;font-weight: bold;'";
    }
    echo "<a {$style} href = './list.php?page={$i}{$link}'>{$i}</a>";
  }
  if($page != $totalPage){//다음 페이지가 있다면
    $nextPage = $page + 1;
    echo "<a href = './list.php?page={$nextPage}{$link}'><em class='fa fa-angle-right' style='color:gray;'></em></a>";//다음페이지 버튼 활성화
  }
  echo "<a href = './list.php?page={$totalPage}{$link}'><em class='fa fa-angle-double-right' style='color:gray;'></em></a>";

 ?>

</div>
