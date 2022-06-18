<?php
$pageTitle = 'Twitch Loyalty ByMikiii';
require './parts/header.php';
require './scripts/connection.php';
require './scripts/getAllItems.php';
if(!isset($_SESSION['username'])): ?>
<div class="text-redpink-100 heading text-center font-medium text-5xl relative m-auto top-1/3">
  <h1 class='relative mb-2'>Twitch Loyalty App</h1>
  <h1>ByMikiii</h1>
</div>
<?php endif; ?>

<section class='flex relative mx-auto mt-40'>
  <?php
foreach($items as $item): ?>
  <div class="item relative w-48 h-60 border text-white mr-5">
    <h1><?php echo $item['name'] ?></h1>
    <h2 class='text-sm'><?php echo 'Available: '.$item['items_left'].' / '.$item['max_items_left'] ?></h2>
    <p class='text-xs'><?php echo $item['description']?></p>
    <button class='bg-redpink-100 p-2 py-0.5'><a href="">Redeem</a></button>

  </div>
  <?php
endforeach;
?>
</section>



</body>

</html>