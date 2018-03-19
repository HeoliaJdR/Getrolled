<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";
showArray($_POST);

$db = connectDb();


if ( count($_POST) >= 7 && !empty($_POST["email"]) &&
	!empty($_POST["pwd"]) &&
	!empty($_POST["pwd2"]) &&
	!empty($_POST["nickname"]) &&
	!empty($_POST["connect_id"]) &&
	!empty($_POST["birthday"]) &&
	!empty($_POST["legacy"]) &&
	!empty($_POST["captcha"])){


	$error =false;
	$listOfErrors = [];

	if( !filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL )){
		$error = true;
		$listOfErrors[] = 1;
	}

	//Vérifier le mdp : min 8 caractères, max 24

	if( strlen($_POST["pwd"]) < 8  || strlen($_POST["pwd"]) > 24 ){
		$error = true;
		$listOfErrors[] = 2;
	}

	//Vérifier la confirmation: égal au mdp

	if( $_POST["pwd"] != $_POST["pwd2"] ){
		$error = true;
		$listOfErrors[] = 3;
	}

	//pseudo : min 5 caractères
	if( strlen($_POST["nickname"]) < 3 ){
		$error = true;
		$listOfErrors[] = 6;
	}
	if( strlen($_POST["connect_id"]) < 3 ){
		$error = true;
		$listOfErrors[] = 6;
		echo "non";
	}
	if (strtolower($_POST["captcha"]) != $_SESSION["captcha"]){
		$error=true;
		$listOfErrors[] = 8;
		print_r($_POST);
		echo "<br>";
		print_r($_SESSION);
	}
	if($error){
		$_SESSION["errors_form"] = $listOfErrors;
		$_SESSION["data_form"]=$_POST;


		header("Location: signup.php");

	} else {
		$req = $db->prepare('INSERT INTO account(account_mail, account_pwd, account_login, account_age, account_active, is_admin, account_nickname) VALUES(:email, :pwd, :connect_id, :birthday, :active, :is_admin, :nickname)');
		$req->execute(array(
			'email' => $_POST["email"],
			'pwd' => password_hash($_POST["pwd"], PASSWORD_DEFAULT),
			'connect_id' => $_POST["connect_id"],
			'birthday' => $_POST["birthday"],
			'active' => '1',
			'is_admin' => '0',
			'nickname' => $_POST["nickname"]
			));

		$req2 = $db -> prepare('SELECT account_id FROM account WHERE account_mail=:email');
		$req2 -> execute();
		$account_id=$req2->fetch();

		$req3 = $db-> prepare('INSERT INTO friendlists(user_id)VALUES(:id)');
		$req3 -> execute(['id' => $account_id[0]]);

		header("Location: login.php");
	}


}else{
	die("Access Denied, we know who you are ".$_SERVER["REMOTE_ADDR"]);
}
