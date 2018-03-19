<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";


if(isset($_POST['delete_id']) && isset($_POST['user_id'])){
	$db= connectDb();
	$query = $db->prepare("SELECT * FROM friendlists WHERE user_id=:id");
    $query->execute( ['id'=>$_POST["user_id"]]);
    $resultat=$query->fetch();

    $i=0;
    do{
    	$i++;
    } while ($resultat[$i]!=$_POST['delete_id']);

    $query1 = $db->prepare("UPDATE friendlists SET friend".$i."_id=NULL WHERE user_id=:user_id");
    $query1->execute(['user_id'=>$_POST["user_id"]]);

    $query2 = $db->prepare("SELECT * FROM friendlists WHERE user_id=:id");
    $query2->execute( ['id'=>$_POST["delete_id"]]);
    $resultat2=$query2->fetch();

    $i=0;
    do{
    	$i++;
    } while ($resultat2[$i]!=$_POST['user_id']);

    $query3 = $db->prepare("UPDATE friendlists SET friend".$i."_id=NULL WHERE user_id=:delete_id");
    $query3->execute(['delete_id'=>$_POST['delete_id']]);

} else {
	echo "erreur de paramètres!";
}