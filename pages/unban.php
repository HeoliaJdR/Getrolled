<?php
	require "conf.inc.php";
	require "functions.php";

	session_start();
	$db=connectDb();
    $query = $db->prepare("UPDATE account SET account_active=1 WHERE account_login=:nickname");
    $query -> execute(["nickname" => $_POST["nickname"]]);
    header("Location: admin.php");