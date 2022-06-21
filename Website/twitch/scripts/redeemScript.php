<?php
session_start(); 
if(!isset($_SESSION['username'])){
  header('Location: ../');
}

$item_name = $_GET['item'];

require './connection.php';
require './getCurrentItem.php';

if($currentItem['items_left'] < 1){
    $_SESSION['message'] = 'The item is unavailable.';
    $_SESSION['color'] = 'red';
    header('Location: ../');
}
else if($currentItem['price'] <= $_SESSION['points']){
        $new_items_left = $currentItem['items_left'] - 1;
        $sql = "UPDATE items SET items_left = '$new_items_left' WHERE name = '$item_name';";
        $conn->query($sql);

        $_SESSION['points'] = $_SESSION['points'] - $currentItem['price'];
        $new_user_points = $_SESSION['points'];
        $username = $_SESSION['username'];
        $sql = "UPDATE users SET points = '$new_user_points ' WHERE username = '$username'";
        $conn->query($sql);


    $_SESSION['message'] = 'You successfully redeemed '.$currentItem['name'].'.';
    $_SESSION['color'] = 'green';
    header('Location: ../');
}else{
    $_SESSION['message'] = 'You do not have enough points.';
    $_SESSION['color'] = 'red';
    header('Location: ../');
}

?>