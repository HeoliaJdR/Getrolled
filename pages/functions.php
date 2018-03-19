<?php
require_once"conf.inc.php";


function showArray($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
function connectDb(){
	try {
		$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PWD);
	} catch(Exception $e) {
		die("Erreur SQL : ".$e->getMessage());
	}

	return $db;
}

function isConnected(){
	//Vérifier l'existence des sessions
	if(!empty($_SESSION["token"]) && !empty($_SESSION["email"])){
		$db = connectDb();
		$query=$db -> prepare("SELECT account_id FROM account WHERE token=:token AND account_mail=:email");
		$query -> execute(["token"=>$_SESSION["token"], "email"=>$_SESSION["email"]]);
		if($query->rowCount()){
			//Oauth 2
			$_SESSION["token"] = regenerateAccessToken($_SESSION["email"]);
			return true;
		} else {
			logout();
			return false;
		}
	}
	return false;
}

function logout($redirect = false){
	$db=connectDb();

	$query = $db->prepare("UPDATE account SET token=NULL WHERE account_mail=:email");
    $query -> execute(["email"=>$_SESSION["email"]]);

	if($redirect){
		unset($_SESSION["token"]);
		unset($_SESSION["email"]);
		header("Location: index.php");
	}
}

function regenerateAccessToken($email){
	$accessToken = md5(uniqid()."fhuazhnbaf");

	$_SESSION["token"]=$accessToken;

	$db=connectDb();
	$query = $db->prepare("UPDATE account SET token=:token WHERE account_mail=:email");
    $query -> execute(["token"=>$accessToken,"email"=>$email]);

	return $accessToken;
}
