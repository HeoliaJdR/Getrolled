<?php
session_start();
require_once "conf.inc.php";
require_once "functions.php";
$accessToken = md5(uniqid()."fhuazhnbaf");
echo "oui";
$db=connectDb();

$query = $db->prepare("UPDATE account SET token=:token WHERE account_mail=:email");
$query -> execute(["token"=>$accessToken,"email"=>$_SESSION["email"]]);

return $accessToken;