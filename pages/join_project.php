<?php
session_start();
require "header.php";
require_once "functions.php";

$db = connectDb();

$req_accountid=$db->prepare('SELECT account_id FROM account WHERE account_mail=:email');
$req_accountid->execute(["email"=>$_SESSION["email"]]);
$account_id=$req_accountid->fetch();
if($_SESSION["project_nb"] == 1){
  $_SESSION["first_project"] = $_POST['project_id'];
  $req_prj = $db->prepare("UPDATE account SET account_first_project='".$_POST['project_id']."' WHERE account_id=:account_id");
  $req_prj->execute(array(
    'account_id' => $account_id[0]
  ));
  header("Location: project1.php");
}
elseif($_SESSION["project_nb"] == 2){
  $_SESSION["second_project"] = $_POST['project_id'];
  $req_prj = $db->prepare("UPDATE account SET account_second_project='".$_POST['project_id']."' WHERE account_id=:account_id");
  $req_prj->execute(array(
    'account_id' => $account_id[0]
  ));
  header("Location: project2.php");
}
elseif($_SESSION["project_nb"] == 3){
  $_SESSION["third_project"] = $_POST['project_id'];
  $req_prj = $db->prepare("UPDATE account SET account_third_project='".$_POST['project_id']."' WHERE account_id=:account_id");
  $req_prj->execute(array(
    'account_id' => $account_id[0]
  ));
  header("Location: project3.php");
}
else{
  echo "Wallah il est 4h chui fatigué m'en voulez pas svp *position PLS*";
}
