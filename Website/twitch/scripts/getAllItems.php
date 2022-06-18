<?php
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
$items = [];

while($item = $result->fetch_assoc()){
array_push($items, $item);
}
?>