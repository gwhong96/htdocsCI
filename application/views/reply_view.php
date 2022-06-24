<br><br><br>

      <?php
        $dataCount   = count($replyInfo);
        echo $session;
        ?>

        <form method = "post" action="/board/replyUp" name = "reply0">
          <input type="hidden" value ='0' name = "order">
          <input type="hidden" value ='0' name = "depth">
          <input type="hidden" value ='<?=$boardID?>' name = "boardID">
          <input type="hidden" value ='0' name = "replyPID">
          <textarea style = "padding : 7px;background : #EEE;width:100%;height:80px" name="reply" required></textarea><br>
          <button style = "background :  #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">댓글 저장</button>
        </form>
        <br><br>
    <?php
        if($dataCount>0){
          foreach($replyInfo as $replyInfo){
            $depth      = $replyInfo['replyDepth'];
            $replyID    = $replyInfo['replyID'];
            // $modify     = $replyInfo['modifyDate'];
            echo "<div>";
            if($depth == 0){//댓글
              echo "--";
            }else{//대댓글 이하
              for ($j = 0; $j < $depth; $j++){
                echo "&nbsp&nbsp&nbsp&nbsp";
              }
              echo "ㄴ";
            }

            if($replyInfo['delYN'] == 'N'){
              echo $replyInfo['writer']."&nbsp:&nbsp";
              echo nl2br($replyInfo['reply'])."&nbsp&nbsp&nbsp";
              echo $replyInfo['replyDate']."&nbsp";
            }else{
              echo "삭제된 댓글 입니다.";
            }

          ?>
          <button class = 'button1 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style="background :  #6D6E71" reply_id="<?=$replyID?>">답글</button>
          <?php
          if($replyInfo['writerID'] == $_SESSION['memberID'] && $replyInfo['delYN'] == 'N'){?>
            <button class = 'button2 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style="background : #3687a8;" modify_id="<?=$replyID?>">수정</button>
            <?= "<button class = 'button2 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style='background :  #fd0000'/><a href = 'board/reply_delete?replyID={$replyID}&boardID={$boardInfo[0]['boardID']}'>삭제</a></button>"?>
          <?php }?>

          <?php
            echo "</div><br>";
            ?>
            <form id = "replyWrite<?=$replyID?>" method = "post" action="/board/replyUp" style="display:none">
              <input type="hidden" value ='<?=$replyInfo['replyOrder']?>' name = "order">
              <input type="hidden" value ='<?=$depth?>' name = "depth">
              <input type="hidden" value ='<?=$boardID?>' name = "boardID">
              <input type="hidden" value ='<?=$replyID?>' name = "replyPID">
              <textarea style="background : #EEE" name="reply" cols = "30" rows = "3" required></textarea>
              <button style = "background :  #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">답글 저장</button>
              <br>
            </form>

            <form id = "replyModify<?=$replyID?>" method = "post" action="./reply_modify.php" style="display:none">
              <input type="hidden" value ='<?=$boardID?>' name = "boardID">
              <input type="hidden" value ='<?=$replyID?>' name = "replyID">
              <textarea style="background : #EEE" name="reply" cols = "30" rows = "3" required><?=$replyInfo['reply']?></textarea>
              <button style = "background : #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">답글 수정</button>
              <br>
            </form>
            <?php
          }//foreach문 끝나는 지점
        }else{
          echo "댓글이 없습니다.";
        }
      ?>
