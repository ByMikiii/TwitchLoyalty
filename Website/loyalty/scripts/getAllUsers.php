<?php 
if(isset($page_first_result)){
    $sql="SELECT s.*, @rownum := @rownum + 1 AS userOrder,username,points,watchtime FROM users s, (SELECT @rownum := $page_first_result) r ORDER BY ".$order." ".$sort.", username asc LIMIT " . $page_first_result .", " .$results_per_page.";";
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