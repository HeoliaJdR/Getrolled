<?php
session_start();
// require "header.php";
require_once "functions.php";

$db = connectDb();

$req_accountid=$db->prepare('SELECT account_id FROM account WHERE account_mail=:email');
$req_accountid->execute(["email"=>$_SESSION["email"]]);
$account_id=$req_accountid->fetch();
$req_prj = $db->prepare('UPDATE account SET account_first_project=NULL WHERE account_id=:account_id');
$req_prj->execute(array(
  'account_id' => $account_id[0]
));

header('Location: project1.php');