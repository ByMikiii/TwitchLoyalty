<?
if(isset($_SESSION['username'])){
$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
$result = $conn->query($sql);


if($currentUser = $result->fetch_assoc()){

}
}