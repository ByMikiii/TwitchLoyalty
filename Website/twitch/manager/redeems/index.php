<?php
$pageTitle = 'All Redeemed Items';
require '../../parts/header.php';
    require '../../scripts/connection.php';
    require '../../scripts/getAllRedeemed.php';

require '../../scripts/getCurrentUser.php';
if(isset($currentUser['admin'])){
if($currentUser['admin'] == 0){
    exit;
}}else exit;
?>

<section class="mx-auto w-5/6 text-left  h-3/4 overflow-scroll mt-10">
<h2 class="text-2xl text-gray-200 border-b-2 border-redpink-100 pl-2  ">Redeemed Items</h2>
    <div class="flex text-redpink-100 ml-4 text-xl mb-3">
        <h2 class="">Username</h2>
        <h2 class="mx-auto">Item Name</h2>
        <h2 class="mr-12">Price</h2>
        <h2 class="ml-auto">Date</h2>
    </div>
    <?php
    foreach ($redeemedAllItems as $redeemedAllItem) :
    ?>
        <div class="grid text-gray-200 text-center grid-cols-4 ml-5  mb-2.5">
            <h2 class="mr-auto"><?php echo $redeemedAllItem['username'] ?> </h2>
            <h2 class="mr-10"><?php echo $redeemedAllItem['item_name'] ?> </h2>
            <h2 class="ml-20"><?php echo $redeemedAllItem['price'] ?></h2>
            <h2 class="ml-auto"><?php echo $redeemedAllItem['date_created'] ?></h2>
        </div>

    <?php endforeach; ?>
    </div>
</section>
<?php require '../../parts/footer.php' ?>