<?php 
if(isset($page_first_result)){
$sql = "SELECT * FROM users ORDER BY points DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
$result = $conn->query($sql);
$users = [];

while($user = $result->fetch_assoc()){
array_push($users, $user);
}
}

$sql = "SELECT * FROM users;";
$result = $conn->query($sql);
$numberOfUsers = 0;
$allUsers = [];

while($allUser =$result->fetch_assoc()){
array_push($allUsers, $allUser);
$numberOfUsers++;
}