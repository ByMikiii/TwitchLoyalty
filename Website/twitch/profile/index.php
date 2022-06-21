<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../');
}
$pageTitle = 'Profile - '.$_SESSION['username'];
require '../parts/header.php';
?>
<h1 class="text-3xl text-gray-200 text-center mt-10 mb-7"><?php echo $_SESSION['username'] ?></h1>

<section>
<h2 class="text-2xl text-redpink-100 mx-auto w-5/6 text-left pl-3 border-b-2 border-redpink-100">Redeemed Items</h2>

</section>