<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

$db=connectDb();
if(isset($_POST["idattribute"])){
	$query= $db->prepare("DELETE FROM project_inv_attribute WHERE pr_inv_attr_id=:id");
	$query->execute(["id"=>$_POST["idattribute"]]);
}

if(isset($_POST["idspell"])){
	$query= $db->prepare("DELETE FROM project_inv_spell WHERE pr_inv_spell_id=:id ");
	$query->execute(["id"=>$_POST["idspell"]]);
}

if(isset($_POST["iditem"])){
	$query= $db->prepare("DELETE FROM project_inv_item WHERE pr_inv_item_id=:id");
	$query->execute(["id"=>$_POST["iditem"]]);
}