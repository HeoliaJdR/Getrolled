<?php
session_start();
require "header.php";
require_once "conf.inc.php";
try
{
	$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PWD);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


if(isset($_POST["nicknameModifier"])){
	$query2 = $db->prepare("SELECT account_nickname, account_pwd FROM account WHERE token=:token");
	$query2->execute( ["token"=>$_SESSION["token"]]);
	$testpwd=$query2->fetch();
	print_r($_POST);
	print_r($testpwd);
	if(!empty($_POST["nicknameModifier"] && password_verify($_POST["pwd"] , $testpwd[1]))){
		$query = $db->prepare("UPDATE account SET account_nickname='".$_POST["nicknameModifier"]."' WHERE token=:token");
		$query->execute( ["token"=>$_SESSION["token"]]);
		$query1 = $db->prepare("UPDATE comments SET sender_nickname='".$_POST["nicknameModifier"]."' WHERE sender_nickname=:oldnickname");
		$query1->execute( ["oldnickname"=>$testpwd[0]]);
		$_SESSION["pwderror"] = 0;
		header("Location: profil.php");
	} else {
		$_SESSION["pwderror"] = 1;
		header("Location: profil.php");
	}
}

if(isset($_POST["birthdayModifier"])){
	$query2 = $db->prepare("SELECT account_pwd FROM account WHERE token=:token");
	$query2->execute( ["token"=>$_SESSION["token"]]);
	$testpwd=$query2->fetch();

	if(!empty($_POST["birthdayModifier"] && password_verify($_POST["pwd"] , $testpwd[0]))){
		$query = $db->prepare("UPDATE account SET account_age='".$_POST["birthdayModifier"]."' WHERE token=:token");
		$query->execute( ["token"=>$_SESSION["token"]]);
		$_SESSION["pwderror"] = 0;
		header("Location: profil.php");
	} else {
		$_SESSION["pwderror"] = 1;
		header("Location: profil.php");
	}
}

if(isset($_POST["emailModifier"])){
	$query2 = $db->prepare("SELECT account_pwd FROM account WHERE token=:token");
	$query2->execute( ["token"=>$_SESSION["token"]]);
	$testpwd=$query2->fetch();

	if(!empty($_POST["emailModifier"] && password_verify($_POST["pwd"] , $testpwd[0]))){
		$query = $db->prepare("UPDATE account SET account_mail='".$_POST["emailModifier"]."' WHERE token=:token");
		$query->execute( ["token"=>$_SESSION["token"]]);
		$_SESSION["pwderror"] = 0;
		header("Location: profil.php");
	} else {
		$_SESSION["pwderror"] = 1;
		header("Location: profil.php");
	}
}

if(isset($_POST["loginModifier"])){
	$query2 = $db->prepare("SELECT account_pwd FROM account WHERE token=:token");
	$query2->execute( ["token"=>$_SESSION["token"]]);
	$testpwd=$query2->fetch();

	if(!empty($_POST["loginModifier"] && password_verify($_POST["pwd"] , $testpwd[0]))){
		$query = $db->prepare("UPDATE account SET account_login='".$_POST["loginModifier"]."' WHERE token=:token");
		$query->execute( ["token"=>$_SESSION["token"]]);
		$_SESSION["pwderror"] = 0;
		header("Location: profil.php");
	} else {
		$_SESSION["pwderror"] = 1;
		header("Location: profil.php");
	}
}
