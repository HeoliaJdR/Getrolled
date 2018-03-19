<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

$db=connectDb();
print_r($_POST);

$query=$db->prepare("INSERT INTO project_inv_item(pr_inv_item_name,pr_inv_item_desc, pr_inv_item_attr1,pr_inv_item_attr1_desc,pr_inv_item_attr2,pr_inv_item_attr2_desc,pr_inv_item_attr3,pr_inv_item_attr3_desc,pr_inv_item_spell1,pr_inv_item_spell2,pr_inv_item_spell3,pr_inv_item_attr_hot_dot,project_inv_item_list_id) VALUES(:name,:descr,:attr1,:descattr1,:attr2,:descattr2,:attr3,:descattr3,:spell1,:spell2,:spell3,:hotdot,:id)");
if($query->execute(["name"=>$_POST["name"],
					"descr"=>$_POST["desc"],
					"attr1"=>$_POST["attr1"],
					"descattr1"=>$_POST["descattr1"],
					"attr2"=>$_POST["attr2"],
					"descattr2"=>$_POST["descattr2"],
					"attr3"=>$_POST["attr3"],
					"descattr3"=>$_POST["descattr3"],
					"spell1"=>$_POST["spell1"],
					"spell2"=>$_POST["spell2"],
					"spell3"=>$_POST["spell3"],
					"hotdot"=>$_POST["hotdot"],
					"id"=>$_SESSION["itemid"]])){
	echo'oui';
}
print_r($query);
