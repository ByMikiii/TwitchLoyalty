<?php
if(isset($_GET['search'])) {
    $searchUsername = $_GET['search'];

    if(strlen($searchUsername) >= 3){
        $search = "'%".$searchUsername."%'";
    }else{
        $search = "'".$searchUsername."%'";
    }

    if (isset($page_first_result)) {
        $sql = "SELECT * FROM users WHERE username LIKE ".$search." ORDER BY points DESC LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = $conn->query($sql);
        $users = [];

        while ($user = $result->fetch_assoc()) {
            array_push($users, $user);
        }
    }

    $sql = "SELECT * FROM users;";
    $result = $conn->query($sql);
    $numberOfUsers = 0;
    $allUsers = [];

    while ($allUser = $result->fetch_assoc()) {
        array_push($allUsers, $allUser);
        $numberOfUsers++;
    }
}
?>
