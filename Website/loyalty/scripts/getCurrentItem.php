<?php
if (isset($_SESSION['username'])) {
    $sql = "SELECT * FROM items WHERE name = '".$item_name."'";
    $result = $conn->query($sql);

    $currentItem = $result->fetch_assoc();
}