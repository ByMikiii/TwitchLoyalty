<?php
require './connection.php';
if(isset($_GET['item'])){
    $item_name = $_GET['item'];
    echo $item_name;

    $sql = "DELETE FROM items WHERE name='$item_name'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    }
    header('Location: /loyalty/manager/');
}