<?php
$pageTitle = 'Items Manager';
require '../parts/header.php';
require '../scripts/getAllItems.php';
require '../scripts/getCurrentUser.php';
if(isset($currentUser['admin'])){
if($currentUser['admin'] == 0){
    exit;
}}else exit;
?>

<div class='items-table w-2/3 text-white mt-8 mx-auto text-left px-4 py-2 border-2 border-redpink-100 rounded-md overflow-scroll h-auto max-height'>
    <span id='table-heading' class="p-2 pl-4">Name</span>
    <span id='table-heading' class="p-2 pl-3">Price</span>
    <span id='table-heading' class="p-2 pl-3">Available</span>
    <span id='table-heading' class='text-right p-2 pr-9'></span>
    <span id='table-heading' class='text-right p-2 pr-7'></span>
    <span id='table-heading' class='text-right p-2 pr-7'></span>

    <?php
foreach ($items as $item): ?>
    <span id='table-item' class='text-left p-2 border-b-2 h-12'><?php echo $item['name']?></span>
    <span id='table-item' class="p-2 border-b-2 h-12"><?php echo $item['price']?></span>
    <span id='table-item' class='text-center p-2 border-b-2 h-12'><?php echo $item['items_left']?></span>
    <span id='table-item' class='text-right p-2 pt-3 border-b-2 pr-10 h-12'>
        <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
  <input type="checkbox" value="" id="default-toggle" class="sr-only peer">
  <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
</label>
    </span>
    <span id='table-item' class="text-right p-2 border-b-2 pr-8 h-12"><button class="bg-blue-600 p-4 py-1 rounded-md hover:brightness-125"><a href="">Edit</a></button></span>
    <span id='table-item' class="text-right p-2 border-b-2 pr-8 h-12"><button class="bg-redpink-100 p-3 py-1 rounded-md hover:brightness-125"><a href="">Delete</a></button></span>
<?php endforeach;?>
</div>

<button class="bg-redpink-100 p-2 rounded-md absolute left-1/2 bottom-8 -translate-x-1/2 hover:brightness-125"><a href="./create/">Create New Items</a></button>
