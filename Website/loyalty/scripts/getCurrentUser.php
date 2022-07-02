<?php
if(isset($_SESSION['username'])){
$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
$result = $conn->query($sql);


 $currentUser = $result->fetch_assoc();
}