<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM redeemed_items WHERE username = '$username'";
    $result = $conn->query($sql);

    $redeemedItems = [];

    while($redeemedItem = $result->fetch_assoc()){
        array_push($redeemedItems, $redeemedItem);
    }
}