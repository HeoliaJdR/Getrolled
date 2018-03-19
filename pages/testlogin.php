<?php
session_start();
require "conf.inc.php";
require "functions.php";


if ( count($_POST) == 2 && !empty($_POST["loginemail"]) && !empty($_POST["loginpwd"])) {
	$db=connectDb();
	$error=false;
	$listOfErrors=[];

	$query2 = $db->prepare("SELECT account_pwd FROM account WHERE account_mail=:email");
	$query2->execute( ["email"=>$_POST["loginemail"]]);
	$testpwd=$query2->fetch();
	if(password_verify($_POST["loginpwd"] , $testpwd[0])){

		$req_accountid=$db->prepare('SELECT account_id FROM account WHERE account_mail=:email');
		$req_accountid->execute(["email"=>$_SESSION["email"]]);
		$account_id=$req_accountid->fetch();
		$_SESSION["account_id"] = $account_id;
		$_SESSION['email']=$_POST['loginemail'];
		$_SESSION["token"] = regenerateAccessToken($_SESSION["email"]);
        $_SESSION["errors_form"] = NULL;
        header("location: index.php");

	} else {
		$error = true;
		$listOfErrors[] = 9;

		if($error){
			$_SESSION["errors_form"] = $listOfErrors;
			header("Location: login.php");
		}
	}
} else {
	die("accès refusé");
}
