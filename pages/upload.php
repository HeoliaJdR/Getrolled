<?php
session_start();
require_once "header.php";
require_once "functions.php";
require_once "conf.inc.php";

if(isset($_FILES["avatar"])){
	$db=connectDb();
	$query = $db->prepare("SELECT * FROM account WHERE token=:token");
    $query->execute( ["token"=>$_SESSION["token"]]);
    $resultat=$query->fetch();
	$_FILES["avatar"]["name"]="av".$resultat[0];
	$querypath= $db -> prepare("UPDATE account SET account_avatar ='../avatars/".$_FILES["avatar"]["name"].".jpg' WHERE token='".$_SESSION["token"]."'");
	$querypath->execute();
	move_uploaded_file($_FILES["avatar"]["tmp_name"], "../avatars/".$_FILES["avatar"]["name"].".jpg");
	chmod("../avatars/".$_FILES["avatar"]["name"].".jpg", 0777);
	header("Location: profil.php");
}