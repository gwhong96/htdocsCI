<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">DETAIL</h4>
</div>
<br>
<?php
  if(count($boardInfo[0]) > 0){//값이 있다면?
    ?>
    <div class="flex items-center p-6 dark:bg-gray-900 shadow-xs">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg dark:bg-gray-800">
    <div class="w-full" style="">
      <span style="color: rgb(64,64,64);" class="mb-4 text-2xl font-semibold text-gray-700"> <?=$boardInfo[0]['title']?> </span>
      <span class="text-xs text-gray-700">by</span>
      <span class="text-xl" style="color:gray"><?=$boardInfo[0]['nickName']?></span> <br><br>
      <?= $regTime = date("Y-m-d H:i:s") ?>
      <span style="float:right">Writen : <?=$boardInfo[0]['regTime']?></span><br>
      <span style="float:right">Modified : <?= $boardInfo[0]['lastUpdate']?></span><br><br><br>
      <div style="padding:7px;border: 1px solid #d3d3d3;min-height: 250px;"><?=nl2br($boardInfo[0]['content'])?></div>
      <br><br>
      <?= "첨부파일 : "?><br>
      <?php echo "첨부파일 없음";
    }else{
      echo "잘못된 접근입니다.";
      echo "<a href = '/board/list_board?page=1'>게시판</a>";
      exit;
    }
    ?>
