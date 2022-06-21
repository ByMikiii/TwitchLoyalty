<?php
$pageTitle = 'Create Item';
require '../../parts/header.php';
require '../../scripts/getCurrentUser.php';

if(isset($currentUser['admin'])){
    if($currentUser['admin'] == 0){
        exit;
    }}else exit;
?>
<section>
    <form action="../../scripts/createItem.php" method="post" class="flex flex-col w-1/5 m-auto mt-40">
        <input type="name" name="name" placeholder="Name" class="create-input" maxlength="25" required>
        <input type="number" name="price" placeholder="Price" class="create-input" required>
        <textarea name="description" placeholder="Description" class="create-input h-24" required></textarea>
        <input type="number" name="items_left" placeholder="Items Available" class="create-input" required>
        <input type="url" name="url_image" placeholder="URL of Image" class="create-input" required>
        <button type="submit" class="bg-redpink-100 mt-4 p-2 w-20 mx-auto rounded-md hover:brightness-125"> Create </button>








    </form>
</section>
