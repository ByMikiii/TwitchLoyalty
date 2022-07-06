<?php
if(isset($_GET['item'])){
    $item_name = $_GET['item'];
}else {header('Location: ../../');}
$pageTitle = 'Edit - '.$item_name;
require '../../parts/header.php';
require '../../scripts/connection.php';
require '../../scripts/getCurrentUser.php';
require '../../scripts/getCurrentItem.php';

if(isset($currentUser['admin'])){
    if($currentUser['admin'] == 0){
        exit;
    }}else exit;
$activeValue = '';
if($currentItem['active'] == 1){
    $activeValue = 'checked';
}
?>

<section class="w-1/5 m-auto mt-32 text-darkblue-100">
    <h1 class="text-redpink-100 text-center font-bold text-4xl mb-5">Editing <?php echo $item_name;?></h1>
    <p class="text-redpink-100 text-center ">(Only letters, numbers and spaces are allowed!)</p>
    <form action="../../scripts/editItem.php" method="post" class="flex flex-col">
        <label class="text-redpink-100" for="name">Name:</label>
        <input type="name" name="name" value="<?php echo $currentItem['name'] ?>" class="create-input" maxlength="18" required autocomplete="off">
        <label class="text-redpink-100" for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $currentItem['price'] ?>" class="create-input" required autocomplete="off">
        <label class="text-redpink-100" for="description">Description:</label>
        <textarea name="description" class="create-input h-24 scrollbar-hide" required autocomplete="off"><?php echo $currentItem['description'] ?></textarea>
        <label class="text-redpink-100" for="items_left">Items left:</label>
        <input type="number" name="items_left" value="<?php echo $currentItem['items_left'] ?>" class="create-input" required autocomplete="off">
        <label class="text-redpink-100" for="url_image">Image URL:</label>
        <input type="url" name="url_image" value="<?php echo $currentItem['url_image'] ?>" class="create-input" required autocomplete="off">

        <label class="text-redpink-100" for="active">Active:</label>
        <div class="text-center ml-8">
        <label for="red-toggle" class="inline-flex relative items-center mr-5 cursor-pointer">
            <input type="checkbox" name="active" id="red-toggle" class="sr-only peer" <?php echo $activeValue;?>>
            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
        </label>
        </div>

        <input type="hidden" name="oldItemName" value="<?php echo $item_name?>">
        <button type="submit" class="text-darkblue-100 bg-redpink-100 font-bold mt-4 p-2 w-20 mx-auto rounded-md hover:brightness-125" > Edit </button>

    </form>
</section>





<?php
require '../../parts/footer.php'?>

