
<?php

  if(isset($data)  && count($data) > 0){
    foreach ($data as $key => $value) {
      print_r( $value);
      // code...
          ?>
<!-- <div><?=$value['memberID']?></div>
<div><?=$value['nickName']?></div>
<div><?=$value['memberPW']?></div>
<div><?=$value['birthDay']?></div>
<div><?=$value['email']?></div>
<div><?=$value['gender']?></div>
<div><?=$value['modifyTime']?></div> -->
          <?php
    }
  }

  if(isset($_SESSION['memberID'])){//회원정보 수정일 때
    $memberID = $_SESSION['memberID'];
    $sql = "SELECT memberID, nickName, memberPW, email, birthDay FROM member WHERE memberID = {$memberID}";

    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>회원정보 수정</h4></div>";
  }else{//회원가입일 때
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>회원가입</h4></div>";
  }



 ?>
 <div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
  <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
    <div class="flex flex-col overflow-y-auto md:flex-row">
      <div class="h-32 md:h-auto md:w-1/2">
        <img
            aria-hidden="true"
            class="object-cover w-full h-full dark:hidden"
            src="/public/image/create-account-office.jpeg"
            alt="Office"
          />

      </div>

      <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
        <div class="w-full">
          <form name = "signUp" method = "post" action="/board/signUp">
            <?php
            if(isset($_SESSION['memberID'])){
            ?>
            <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">회원정보 수정</h1>
          <?php }else{?>
            <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">회원 가입</h1>
          <?php } ?>
          <br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">E-mail</span>
              <input style = "background-color : lightgray" type = "email" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userEmail" value = "<?= (isset($memberInfo['email']) ? $memberInfo['email'] : '') ?>" required>
            </label>

            <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Nick-name</span>
              <input style = "background-color : lightgray" type = "text" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userNickName" value = "<?= (isset($memberInfo['nickName']) ? $memberInfo['nickName'] : '') ?>" required>
            </label>

            <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Password</span>
              <input name = "userPW" style="background:lightgray" type = "password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"  required>
            </label>

            <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Password_Check</span>
              <input  name = "userPW_check" style="background:lightgray" type = "password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
            </label>


            <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Gender</span><br><br>
              <input type = "radio" name = "gender" value="m" checked>남
              <input type = "radio" name = "gender" value="w">여
            </label>
            <br>
            <label>
              <span class="text-gray-700 dark:text-gray-400">Birth-Date : </span>
              <?php
                if(isset($memberInfo['memberID'])){
              ?>
                <input type = "date"  value = "<?=$memberInfo['birthDay']?>" name = "birth">
                <br><br>
                <button type="submit" style="background:gray" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                  수정정보 저장</button>
              <?php
              }else{
               ?>
              <input type = "date" name = "birth">
              <br><br>
              <button type="submit" style="background:gray" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                회원가입</button>
              <?php
            }
            ?>
            </label>
          </form>
      </div>
    </div>
  </div>
  </div>
  </div>
