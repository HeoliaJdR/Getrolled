<?php
require_once "chat_modele.php";
require_once "functions.php";

$bdd = connectDB();

echo $_POST['message'];
if(isset($_POST['message']))
{

	ajout_message($bdd,$_POST['message']);

}
else
{
	expire_message($bdd);
	$message = message($bdd);
	require_once("chat_vue.php");
}

?>
