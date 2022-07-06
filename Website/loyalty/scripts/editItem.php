<?php
$oldItemName = $_POST['oldItemName'];
$itemName = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$items_left = $_POST['items_left'];
$url_image = $_POST['url_image'];

if(isset($_POST['active'])){
    $active = 1;
}else $active = 0;

require './connection.php';
require './getCurrentUser.php';

if (strpos($itemName, '#') !== false){
    header('Location: ../manager/?message=Error while editing item. :(');
}else{
$sql = "UPDATE items SET name = '$itemName', price = ".$price.", description = '$description', items_left = ".$items_left.", url_image = '$url_image', active = ".$active." WHERE name = '$oldItemName';";
if ($conn->query($sql) === TRUE) {
    header('Location: ../manager/?message=Item edited successfully. :)');
} else{
    header('Location: ../manager/?message=Error while editing item. :(');
}
}
?>
