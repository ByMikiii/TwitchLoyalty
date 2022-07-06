<?php
$pageTitle = 'Items Manager';
require '../parts/header.php';
require '../scripts/connection.php';
require '../scripts/getAllItems.php';
require '../scripts/getCurrentUser.php';
if(isset($currentUser['admin'])){
if($currentUser['admin'] == 0){
    exit;
}}else exit;
?>
<?php if(isset($_GET['message'])):?>
<p class="text-center text-gray-200 mt-3"><?php echo $_GET['message']?></p>
<?php endif;?>
<section class="border-2 border-redpink-100 rounded-md w-3/4 h-2/3 mt-16 mx-auto overflow-y-auto scrollbar-hide">
<div class='items-table text-white mx-auto text-left px-6 py-2 h-auto'>
    <span id='table-heading' class="p-2 pl-4">Name</span>
    <span id='table-heading' class="p-2 pl-3">Price</span>
    <span id='table-heading' class="p-2 pl-3">Available</span>
    <span id='table-heading' class='text-right p-2 pr-12'></span>
    <span id='table-heading' class='text-right p-2 pr-7'></span>

    <?php
    $i = 1;
foreach ($items as $item): ?>
    <span id='table-item' class='text-left p-2 pl-4 border-b-2 h-12 overflow-hidden'><?php echo $item['name']?></span>
    <span id='table-item' class="p-2  pl-7 border-b-2 h-12"><?php echo $item['price']?></span>
    <span id='table-item' class='text-center p-2 border-b-2 h-12'><?php echo $item['items_left']?></span>
    <span id='table-item' class="text-right p-2 border-b-2 h-12"><button class="bg-blue-600 p-4 py-1 rounded-md hover:brightness-125"><a href="./edit/<?php echo '?item='.$item['name']?>">Edit</a></button></span>
    <span id='table-item' class="text-right p-2 border-b-2 h-12"><button class="bg-redpink-100 p-3 py-1 rounded-md hover:brightness-125"><a href="../scripts/delete.php<?php echo '?item='.$item['name']?>">Delete</a></button></span>
<?php endforeach;?>
</div>

<div class="absolute left-1/2 bottom-8 -translate-x-1/2">
<button class="text-darkblue-100 bg-redpink-100 font-bold p-2 rounded-md hover:brightness-125 mx-4"><a href="./create/">Create New Items</a></button>
<button class="text-darkblue-100 bg-redpink-100 font-bold p-2 rounded-md hover:brightness-125 mx-4"><a href="./redeems/">Show All Reddems</a></button>
</div>
</section>
<?php require '../parts/footer.php' ?>