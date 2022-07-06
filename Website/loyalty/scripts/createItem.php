<?php
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$itemsLeft = $_POST['items_left'];
$urlImage = $_POST['url_image'];

require './connection.php';
 $sql = "INSERT INTO items (name, price, description, items_left, url_image) VALUES ('$name', '$price', '$description', '$itemsLeft', '$urlImage');";
$conn->query($sql) === TRUE;

header('Location: ../manager/?message=Item created successfully. :)');

