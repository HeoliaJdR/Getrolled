<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

$db=connectDb();
print_r($_POST);

$query=$db->prepare("INSERT INTO project_inv_spell(pr_inv_spell_name,pr_inv_spell_desc, pr_inv_spell_attr1,pr_inv_spell_attr1_desc,pr_inv_spell_attr2,pr_inv_spell_attr2_desc,pr_inv_spell_attr3,pr_inv_spell_attr3_desc,pr_inv_spell_attr_hot_dot,pr_inv_spell_req_item,project_inv_spell_list_id) VALUES(:name,:descr,:attr1,:descattr1,:attr2,:descattr2,:attr3,:descattr3,:hotdot,:reqitem,:id)");
if($query->execute(["name"=>$_POST["name"],
					"descr"=>$_POST["desc"],
					"attr1"=>$_POST["attr1"],
					"descattr1"=>$_POST["descattr1"],
					"attr2"=>$_POST["attr2"],
					"descattr2"=>$_POST["descattr2"],
					"attr3"=>$_POST["attr3"],
					"descattr3"=>$_POST["descattr3"],
					"hotdot"=>$_POST["hotdot"],
					"reqitem"=>$_POST["reqitem"],
					"id"=>$_SESSION["spellid"]])){
						echo "oui";
}
print_r($query);
