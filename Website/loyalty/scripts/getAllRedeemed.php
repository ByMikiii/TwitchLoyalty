<?php

if (isset($_SESSION['username'])) {
    $sql = "SELECT * FROM redeemed_items";
    $result = $conn->query($sql);

    $redeemedAllItems = [];

    while ($redeemedAllItem = $result->fetch_assoc()) {
        array_push($redeemedAllItems, $redeemedAllItem);
    }
}