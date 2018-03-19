<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";


$db = connectDb();
// Selection de l'user
$req_accountid=$db->prepare('SELECT account_id FROM account WHERE account_mail=:email');
$req_accountid->execute(["email"=>$_SESSION["email"]]);
$account_id=$req_accountid->fetch();
$_SESSION["account_id"] = $account_id[0];

$prj_own_id = $db->prepare('SELECT project_id FROM project WHERE project_owner='.$account_id[0]);
$prj_own_id->execute();
$testj=$prj_own_id->fetch();

showArray($account_id);
showArray($_SESSION);

$prj_delete = $db->prepare('UPDATE project SET is_deleted="1" WHERE project_owner='.$account_id[0]);
$prj_delete->execute();

$move_to_trash = $db->prepare('UPDATE project SET project_owner="6" WHERE is_deleted="1"');
$move_to_trash->execute();
$_SESSION["project_owned"] = null;

header("Location: delete_project.php");
