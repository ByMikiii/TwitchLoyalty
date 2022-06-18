<?php 
$pageTitle = 'Leaderboard';
require '../parts/header.php';

if (!isset ($_GET['page']) ) {  
  $page = 1;  
} else {  
  $page = $_GET['page'];  
}  

if($page > 1){
  $pageMinus = $page - 1;
}else $pageMinus = 1;
$pagePlus = $page + 1;
if($page - 2 <= 1){
  $firstPagination =  1;
}else $firstPagination = $page - 2;
$results_per_page = 20;  
$page_first_result = ($page-1) * $results_per_page;

require '../scripts/connection.php';
require '../scripts/getAllUsers.php';

$maxPage = ceil($numberOfUsers / $results_per_page);


?>
<div class='grid-table w-2/3 h-3/4 text-white mt-8 mx-auto text-left px-4 py-2 border-2 border-redpink-100 rounded-md'>
  <span id='table-heading'></span>
  <span id='table-heading'>Username</span>
  <span id='table-heading'>Watchtime [Hours]</span>
  <span id='table-heading' class='text-right'>Points</span>

  <?php
  $numberOfUser = $page * $results_per_page + 1 - $results_per_page;
foreach($users as $user):
?>
  <span id='table-item' class='text-left'><?php echo $numberOfUser?></span>
  <span id='table-item'><?php echo $user['username']?></span>
  <span id='table-item' class='text-center'><?php echo round($user['points']/60, 2)?></span>
  <span id='table-item' class='text-right'><?php echo $user['points']?></span>
  <?php
$numberOfUser++;
endforeach; ?>


</div>





<section
  class='pagination grid mt-12 justify-center content-center gap-4 grid-flow-col grid-cols-7 w-96 text-center absolute left-1/2 -translate-x-1/2'>

  <?php
  //FIRST NUMBER 
  if($page == 1) $firstButton = $page;
  else $firstButton = $page - 1;

  //SECOND NUMBER
   if($page == 1)  $secondButton = 2;
    else  $secondButton = $page;
    
  //THIRD NUMBER
  if($page == 1) $thirdButton = 3;
  else if($page >= $maxPage){$thirdButton = '';}
  else $thirdButton = $page + 1;


  ?>

  <a class="pagenumber" href="./?page=1">
    << </a>

      <a class="pagenumber" href="<?php if($page > 1){ echo './?page='; echo $page - 1;}?>">
        < </a>

          <a class="pagenumber <?php if($page == $firstButton)echo 'brightness-150'?>"
            href="./?page=<?php echo $firstButton?>"><?php echo $firstButton ?></a>

          <a class="pagenumber <?php if($page == $secondButton)echo 'brightness-150'?>"
            href="./?page=<?php echo $secondButton?> "><?php echo $secondButton ?></a>

          <a class="pagenumber"
            href="<?php if($thirdButton == ''){}else{echo './?page='; echo $thirdButton;} ?> "><?php echo $thirdButton ?></a>

          <a class="pagenumber" href="<?php if($page < $maxPage){ echo './?page='; echo $page + 1;}?>"> > </a>

          <a class="pagenumber" href="./?page=<?php echo $maxPage;?>">
            >> </a>

</section>