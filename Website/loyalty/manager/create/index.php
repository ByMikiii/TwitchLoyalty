<?php
$pageTitle = 'Create Item';
require '../../parts/header.php';
require '../../scripts/connection.php';
require '../../scripts/getCurrentUser.php';

if(isset($currentUser['admin'])){
    if($currentUser['admin'] == 0){
        exit;
    }}else exit;
?>
<section>
    <form action="../../scripts/createItem.php" method="post" class="flex flex-col w-1/5 m-auto mt-40 text-darkblue-100">
        <input type="name" name="name" placeholder="Name" class="create-input" maxlength="18" required autocomplete="off">
        <input type="number" name="price" placeholder="Price" class="create-input" required autocomplete="off">
        <textarea name="description" placeholder="Description" class="create-input h-24" required autocomplete="off"></textarea>
        <input type="number" name="items_left" placeholder="Items Available" class="create-input" required autocomplete="off">
        <input type="url" name="url_image" placeholder="URL of Image" class="create-input" required autocomplete="off">
        <button type="submit" class="text-darkblue-100 bg-redpink-100 font-bold mt-4 p-2 w-20 mx-auto rounded-md hover:brightness-125" > Create </button>

    </form>
</section>

<?php require '../../parts/footer.php' ?>