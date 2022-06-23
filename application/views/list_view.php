<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Q&A</h4>
</div>

<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
<div style="padding-left:250px; padding-right:250px;padding-top:15px;padding-bottom:10px">
  <a style="padding-left:55px" href="./write.php"><em class='fa fa-pencil-square-o' style='color:gray;font-size:24px;'></em></a>
  <a style="float:right; margin-right:30px" href="./signOut.php"><em style="color:#CE181E;font-size:24px;" class="fa fa-power-off"></em></a>
  <a style="float:right; margin-right:30px" href="./signUpForm.php"><em style="color:gray;font-size:24px;" class="fa fa-user"></em></a>
  <a style="float:right; margin-right:30px" href="./csvOutput.php"><em class="fa fa-download" style="color:gray;font-size:24px;"></em></a>
</div>
  <div style="padding-left:250px; padding-right:250px" class="w-full overflow-x-auto">
		<table class="w-full">
      <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="th_sty px-4 py-3">Number</th>
          <th class="th_sty px-4 py-3">Title</th>
          <th class="th_sty px-4 py-3">Writer</th>
          <th class="th_sty px-4 py-3">RegDate</th>
          <th class="th_sty px-4 py-3">Views</th>
          <th class="th_sty px-4 py-3">History</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

      <!--검색 부분 추후 구현-->

       <?php
       $i = $count[0]['board_cnt'];
       foreach($list as $list_b){
         ?>
         <tr class='text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800'>
           <th class="th_sty px-4 py-3"><?=$i-(($_GET['page']-1)*10)?></th>
           <th class="th_sty px-4 py-3"><?=$list_b['title']?></th>
           <th class="th_sty px-4 py-3"><?=$list_b['nickName']?></th>
           <th class="th_sty px-4 py-3"><?=$list_b['regTime']?></th>
           <th class="th_sty px-4 py-3"><?=$list_b['views']?></th>
           <td class='th_sty text-gray-500 px-4 py-3 text-sm'>
             <a href='history.php?boardID={$memberInfo['boardID']}' target = '_blank' onclick='window.open(this.href,'팝업창','width=100, height=100');'>
               <em style='font-size:20px' class='fa fa-history'></em>
             </a>
           </td>
         </tr>

       <?php
       $i = $i-1;
       }
       ?>
       </tbody>
     </table>
    <div class="paging" style="text-align : center">
     <?php echo $paging;?>
   </div>

       <!-- foreach ($list as ) -->
