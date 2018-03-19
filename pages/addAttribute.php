<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

$db=connectDb();
print_r($_POST);

$query=$db->prepare("INSERT INTO project_inv_attribute(	pr_inv_attr_name,pr_inv_attr_min_val, pr_inv_attr_max_val,project_inv_attribute_list_id) VALUES(:name,:min,:max,:id)");
if($query->execute(["name"=>$_POST["name"],
					"min"=>$_POST["min"],
					"max"=>$_POST["max"],
					"id"=>$_SESSION["attributeid"]])){
						echo "oui";
}
print_r($query);
