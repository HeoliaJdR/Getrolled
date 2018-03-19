<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";
showArray($_POST);
showArray($_SESSION);

$db = connectDb();
// Selection de l'user
$req_accountid=$db->prepare('SELECT account_id FROM account WHERE account_mail=:email');
$req_accountid->execute(["email"=>$_SESSION["email"]]);
$account_id=$req_accountid->fetch();
$_SESSION["account_id"] = $account_id[0];

// Séléction des last id


$prj_inv_list_spell_id = $db->prepare('SELECT MAX(project_inv_spell_id) FROM project_inv_spell_list');
$prj_inv_list_spell_id->execute();
$testa=$prj_inv_list_spell_id->fetch();
echo "test1";
echo "<br>";
echo "test1";
$prj_inv_list_item_id = $db->prepare('SELECT MAX(project_inv_item_id) FROM project_inv_item_list');
$prj_inv_list_item_id->execute();
$testb=$prj_inv_list_item_id->fetch();
echo "test2";
echo "<br>";
$prj_inv_list_attribute_id = $db->prepare('SELECT MAX(project_inv_attribute_id) FROM project_inv_attribute_list');
$prj_inv_list_attribute_id->execute();
$testc=$prj_inv_list_attribute_id->fetch();
echo "test3";
echo "<br>";

// Débug affichage
showArray($account_id);

// spells
$req_prj_inv_spell = $db->prepare('INSERT INTO project_inv_spell_list() VALUES()');
$req_prj_inv_spell->execute();
// Item
$req_prj_inv_item = $db->prepare('INSERT INTO project_inv_item_list() VALUES()');
$req_prj_inv_item->execute();
// Attributes
$req_prj_inv_attribute = $db->prepare('INSERT INTO project_inv_attribute_list() VALUES()');
$req_prj_inv_attribute->execute();

//Inventory project
$req_prj_inv = $db->prepare('INSERT INTO project_inv(project_inv_spell_id, project_inv_item_id, project_inv_attribute_id) VALUES(:project_inv_spell_id, :project_inv_item_id, :project_inv_attribute_id)');
$req_prj_inv->execute(array(
  'project_inv_spell_id' => $testa[0]+1,
  'project_inv_item_id' => $testb[0]+1,
  'project_inv_attribute_id' => $testc[0]+1));

$prj_inv_id = $db->prepare('SELECT MAX(project_inv_id) FROM project_inv');
$prj_inv_id -> execute();
$testd=$prj_inv_id->fetch();

$req_prj = $db->prepare('INSERT INTO project(project_name, project_owner, project_inventory) VALUES(:project_name, :project_owner, :project_inventory)');
$req_prj->execute(array(
  'project_name' => $_POST["nameproject"],
  'project_owner' => $account_id[0],
  'project_inventory' => $testd[0]
));

$prj_own_id = $db->prepare('SELECT project_id FROM project WHERE project_owner='.$_SESSION["account_id"]);
$prj_own_id->execute();
$testj=$prj_own_id->fetch();

showArray($_POST["number_attri"]);
showArray($testj);

$_SESSION["project_owned"] = $testj;

$nb_attrib = $_POST["number_attri"];
for ($i = 0; $i < $nb_attrib; $i++) {
  $req_attribute_add = $db->prepare('INSERT INTO project_inv_attribute(project_inv_attribute_list_id) VALUES(:project_inv_attribute_list_id)');
  $req_attribute_add->execute(array(
    'project_inv_attribute_list_id' => $testj[0]
  ));
}

header("Location: validateProject.php");
