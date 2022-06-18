<?php
require './scripts/connection.php';

require './redirect-secret.php';

if(isset($_GET['code'])){
$code = $_GET['code'];

$url = "https://id.twitch.tv/oauth2/token";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "client_id=".$clientId."&client_secret=".$clientSecret."&code=".$code."&grant_type=authorization_code&redirect_uri=".$redirectURI;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);
$resp = json_decode($result,true);

if(isset($resp["access_token"])){
$accessToken = $resp["access_token"];


$url = "https://id.twitch.tv/oauth2/validate";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Authorization: OAuth ".$accessToken,
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);
$resp = json_decode($result,true);
$login = $resp["login"];

require './scripts/getAllUsers.php';

$userFound = false;
foreach ($allUsers as $allUser){
  if ($allUser['username'] == $login){
    $userFound = true;
    $points = $allUser['points'];
  }
}

if(!$userFound && isset($login)){
  $sql = "INSERT INTO users (username, points) VALUES ('".$login."', 1)";
  $conn->query($sql) === TRUE;
  $points = 1;
}
}
}
?>
<form action="./" method="post" id='usernameform' name='usernameform'>
  <input type="hidden" name="username" value="<?php echo $login; ?>">
  <input type="hidden" name="points" value="<?php echo $points; ?>">
</form>
<script>
document.usernameform.submit();
</script>