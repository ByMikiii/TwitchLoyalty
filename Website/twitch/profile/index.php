<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../');
}
$pageTitle = 'Profile - '.$_SESSION['username'];
require '../parts/header.php';
?>
<h1 class="text-3xl text-gray-200 text-center mt-10 mb-7"><?php echo $_SESSION['username'] ?></h1>

<section class="mx-auto w-5/6 text-left  h-1/2 overflow-scroll">
<h2 class="text-2xl text-gray-200 border-b-2 border-redpink-100 pl-2  ">Redeemed Items</h2>
    <div class="flex text-redpink-100 ml-4 text-xl mb-3">
        <h2 class="mr-auto">Item Name</h2>
        <h2 class="mr-12">Price</h2>
        <h2 class="ml-auto">Date</h2>
    </div>
    <?php
    require '../scripts/connection.php';
    require '../scripts/getCurrentRedeemed.php';
    foreach ($redeemedItems as $redeemedItem) :
    ?>
        <div class="grid text-gray-200 text-center grid-cols-3 ml-5 border-b border-gray-200 mb-2.5">
            <h2 class="mr-auto mb-0.5"><?php echo $redeemedItem['item_name'] ?> </h2>
            <h2 class="mb-0.5"><?php echo $redeemedItem['price'] ?></h2>
            <h2 class="ml-auto mb-0.5"><?php echo $redeemedItem['date_created'] ?></h2>
        </div>

    <?php endforeach; ?>
    </div>
</section>
<?php require '../parts/footer.php' ?>