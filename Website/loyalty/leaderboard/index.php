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

if(!isset($_GET['sort'])){ $sort = 'asc'; $order = 'user_order';}
else{
    $sort = $_GET['sort'];
    $order = $_GET['order'];
}


$newSort = $sort;
$newSort == 'desc' ? $newSort = 'asc' : $newSort = 'desc';

if(isset($_GET['search'])){
    require_once('../scripts/search.php');
}else {
    require '../scripts/getAllUsers.php';
}

$maxPage = ceil($numberOfUsers / $results_per_page);


?>
<p id="message" class="relative text-gray-200 text-center message-margins">Synced with twitch channel Resttpowered (All data are since 02. 07. 2022)</p>
<div id="window" class="border-2 border-redpink-100 w-2/3 mx-auto min-height max-h-max rounded-md">
<div class='grid-table text-white text-left px-4 py-2' >
  <span id='table-heading'><a href="?order=user_order&sort=<?php echo $newSort?>">#</a></span>
  <span id='table-heading'><a href="?order=username&sort=<?php echo $newSort?>">Username</a></span>
  <span id='table-heading'><a href="?order=watchtime&sort=<?php echo $newSort?>">Watchtime [Hours]</a></span>
  <span id='table-heading' class='text-right'><a href="?order=points&sort=<?php echo $newSort?>">Points</a></span>

  <?php
  $numberOfUser = $page * $results_per_page + 1 - $results_per_page;
foreach($users as $user):
?>
  <span id='table-item' class='text-left'><?php echo $user['user_order']?></span>
  <span id='table-item'><?php echo $user['username']?></span>
  <span id='table-item' class='text-center'><?php if($user['watchtime'] >= 10)echo round($user['watchtime']); else echo round($user['watchtime'], 2)?></span>
  <span id='table-item' class='text-right'><?php echo $user['points']?></span>
  <?php
$numberOfUser++;
endforeach; ?>


</div>
    </div>

    <form action="./" method="get" class="w-2/3 h-9 mx-auto rounded-md mt-4 mb-0 border-2 border-redpink-100 flex">
    <input type="text" id="search" name="search" class="w-5/6 h-8 bg-inherit text-gray-200 pl-2 flex-auto focus:outline-none" autocomplete="off"
    placeholder="<?php if(!isset($_GET['search'])){ echo 'Search...';}?>" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>" >
    <button class="w-32 h-8 text-redpink-100 ml-auto mr-auto flex-auto border-l-2 border-redpink-100 hover:bg-redpink-100 hover:text-darkblue-100" >Search</button>
    </form>
<?php if(isset($_GET['search']) || isset($_GET['sort'])): ?>
<div class="w-2/3 mx-auto mt-1">
    <a href="./" class="text-redpink-100">Remove Filters</a>
</div>
<?php
    endif;
    if(isset($_GET['search'])): ?>
<script>
    document.getElementById("search").focus();
</script>
<?php endif; ?>



<div class="absolute left-1/2 -translate-x-1/2 bottom-32">
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

          <a class="pagenumber <?php if($page == $firstButton)echo 'brightness-125'?>"
            href="./?page=<?php echo $firstButton?>"><?php echo $firstButton ?></a>

          <a class="pagenumber <?php if($page == $secondButton)echo 'brightness-125'?>"
            href="./?page=<?php echo $secondButton?> "><?php echo $secondButton ?></a>

          <a class="pagenumber"
            href="<?php if($thirdButton == ''){}else{echo './?page='; echo $thirdButton;} ?> "><?php echo $thirdButton ?></a>

          <a class="pagenumber" href="<?php if($page < $maxPage){ echo './?page='; echo $page + 1;}?>"> > </a>

          <a class="pagenumber" href="./?page=<?php echo $maxPage;?>">
            >> </a>

</section>
</div>
<?php require '../parts/footer.php'?>