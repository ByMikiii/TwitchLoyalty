<?php 
if(isset($page_first_result)){
    $sql="SELECT (@row_number:=@row_number+1) AS userOrder,username,points,watchtime FROM users, (SELECT @row_number:=".$page_first_result.") AS x ORDER BY ".$order." ".$sort.", username asc LIMIT " . $page_first_result .", " .$results_per_page.";";
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