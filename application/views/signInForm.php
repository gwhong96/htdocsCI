</div>
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
            <form name = "signIn" method = "post" action = "/board/signIn"><!--입력값 전송 대상 URL-->
              <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">로그인</h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                <input type = "email" name = "userEmail" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
              </label>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input type = "password" name = "userPW" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                <br>
              </label>

                <button style="background:gray" onclick="test();" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                  로그인</button>

            </form>
          </div>
        </div>

<script>
function test() {
  if($('input[name=id]').val() == '') {
      alert("입력해라");
      return false;
      // exit;
  }
  if($('input[name=pw]').val() == '') {
    alert("입력해라");
    return false;
    // exit;
  }
$.ajax({
  url : '/board/signIn',
 	type : 'post',
  data : $('form[name=signIn]').serialize(),
 	cache : false,
 	success : function(data) {
    if(data.result== false) { //로그인 실패
      echo "로그인 실패";
    } else {// 성
      echo "로그인 성곤";
    }
   }
 });
}
//전송버튼
</script>
