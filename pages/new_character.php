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

$req_projectid=$db->prepare('SELECT account_first_project FROM account WHERE account_mail=:email');
$req_projectid->execute(["email"=>$_SESSION["email"]]);
$projectid=$req_projectid->fetch();

echo "projectid :";
showArray($projectid);

// Séléction des last id
$char_inv_list_spell_id = $db->prepare('SELECT MAX(characters_inv_id) FROM characters_spell_inv');
$char_inv_list_spell_id->execute();
$testa=$char_inv_list_spell_id->fetch();
echo "test1";
echo "<br>";
echo "test1";
$char_inv_list_item_id = $db->prepare('SELECT MAX(characters_inv_id) FROM characters_item_inv');
$char_inv_list_item_id->execute();
$testb=$char_inv_list_item_id->fetch();
echo "test2";
echo "<br>";
$char_inv_list_attribute_id = $db->prepare('SELECT MAX(characters_inv_id) FROM characters_attri_inv');
$char_inv_list_attribute_id->execute();
$testc=$char_inv_list_attribute_id->fetch();
echo "test3";
echo "<br>";

$char_inv_id = $db->prepare('SELECT MAX(characters_inv_id) FROM characters_inv');
$char_inv_id -> execute();
$testd=$char_inv_id->fetch();
//Inventory char
$req_char_inv = $db->prepare('INSERT INTO characters_inv(characters_item_inv, characters_attri_inv, characters_spell_inv) VALUES(:characters_item_inv, :characters_attri_inv, :characters_spell_inv)');
$req_char_inv->execute(array(
  'characters_item_inv' => $testd[0]+1,
  'characters_attri_inv' => $testd[0]+1,
  'characters_spell_inv' => $testd[0]+1
));
echo "test4";
echo "<br>";

echo "test5";
echo "<br>";
$req_char = $db->prepare('INSERT INTO characters(characters_name, characters_lvl, characters_inv, characters_project) VALUES(:characters_name, :characters_lvl, :characters_inv, :characters_project)');
$req_char->execute(array(
  'characters_name' => $_POST["char_name"],
  'characters_lvl' => '1',
  'characters_inv' => $testd[0],
  'characters_project' => $_SESSION["first_project"]
));

header("Location: project1.php");
