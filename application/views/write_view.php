<?php

if(isset($_GET['boardID'])){
  $boardID = $_GET['boardID'];
  $sql = "SELECT m.memberID FROM member m JOIN board b ON (m.memberID = b.memberID) WHERE boardID = "."$boardID";
  $result2 = $dbConnect -> query($sql);
  $boardInfo2 = $result2 -> fetch_array(MYSQLI_ASSOC);

  $sql_up = "SELECT * FROM upload_file WHERE boardID = {$boardID}";
  $result_up = $dbConnect -> query($sql_up);
  $uploadInfo = $result_up -> fetch_array(MYSQLI_ASSOC);

  if($boardInfo2['memberID'] == $_SESSION['memberID']){//현재 로그인 계정과 게시글 작성자가 같을때
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>MODIFY</h4>";
    $boardID = $_GET['boardID'];
    $sql = "select * from board where boardID = {$boardID}";
    $result = $dbConnect -> query($sql);
    $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
  }else{
    echo "수정 권한이 없습니다."."<br>";

    echo "<a href = './list_board.php'> 게시글 목록으로 돌아가기</a>";
    exit;
  }
}else{
  echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>WRITE</h4>";
}
 ?>
</div>
<div class="items-center justify-center p-6 sm:p-12 shadow-xs">
 <div class="h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg dark:bg-gray-800">
 <!-- <form name = "boardWrite"> -->
 <form name = "boardWrite" method="POST" action="write_ok.php" enctype="multipart/form-data">
   <input type="hidden" value='<?=$boardID?>' name = "boardID">
     <span class="text-gray-700 dark:text-gray-400">Title</span>
   <br>
   <input style = "background-color : #eee;width:100%;" type = "text" name = "title" class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required value = "<?= (isset($boardInfo['title']) ? $boardInfo['title'] : '') ?>"></input>
   <br>

   <span class="text-gray-700 dark:text-gray-400">Content</span>
   <br>
   <label class="block text-sm">
   <textarea name="content" id="ir1" rows="10" cols="100" style="width:100%"><?= (isset($boardInfo['content']) ? $boardInfo['content'] : '') ?></textarea>
  </label>
   <br>
   <span class="text-gray-700 dark:text-gray-400">Upload File</span>
   <a id="addUploadFileHtml" href="#addUploadFileHtml"><em class="fa fa-plus-circle" style="color:gray;"></em></a>

   <!-- <div class="insert">
           <input type="file" name = "upfile[]" multiple='multiple' onchange="addFile(this);"></input>
           <div class="file-list"></div>
   </div> -->

   <div id="upload_file_html"></div>
   <!-- 쏭 <br><input style="background:gray" type="file" name="upfile[]" class="items-center px-4 py-2 text-sm font-medium text-white rounded-lg"></input><br>-->

   <!-- 다중 첨부파일 추가 -->
   <br><br>
   <span class="text-gray-700 dark:text-gray-400">Lock</span>
   <?php
   if(isset($boardInfo['disYN'])){//게시글 수정일때

     if($boardInfo['disYN'] == 'N'){
       $checkYN = "checked";//기존 공개여부가 N이면 체크
     }else{
       $checkYN = "";
     }
   }else{$checkYN = "";}//게시글 작성일땐 체크 안함
   ?>
   <input type = "checkbox" name = "disYN" value = "N" <?= $checkYN ?>/><br>
   <span class = "text-gray-700 dark:text-gray-400">Password</span>
   <input style = "background-color : #eee" type = "password" name = "boardPW">
   <button id="savebutton" type="submit" style = "background:gray; float:right;" class="items-center px-4 py-2 text-sm font-medium text-white rounded-lg">저장</button>
   <!-- onClick="submitForm(this.form)" -->
 </form>
</div>
</div>
