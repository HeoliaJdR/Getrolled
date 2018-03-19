<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

if(isset($_POST['sender_id']) && isset($_POST['receiver_id'])){
	$db= connectDb();
	$query = $db->prepare("SELECT * FROM friendlists WHERE user_id=:id");
    $query->execute( ['id'=>$_POST["receiver_id"]]);
    $resultat=$query->fetch();

    $i=0;
    do{
    	$i++;
    } while ($resultat[$i]);

    $query1 = $db->prepare("UPDATE friendlists SET friend".$i."_id=:sender_id WHERE user_id=:receiver_id");
    $query1->execute(['receiver_id'=>$_POST["receiver_id"],
    				'sender_id'=>$_POST['sender_id']]);
    $query3 = $db->prepare("UPDATE friendlists SET friend".$i."_id=:receiver_id WHERE user_id=:sender_id");
    $query3->execute(['receiver_id'=>$_POST["receiver_id"],
                    'sender_id'=>$_POST['sender_id']]);

    $query2 = $db->prepare("UPDATE friendrequests SET is_accepted=1 WHERE receiver_id=:receiver_id AND sender_id=:sender_id");
    $query2->execute(['receiver_id'=>$_POST["receiver_id"],
    				'sender_id'=>$_POST['sender_id']]);
} else {
	echo "erreur de paramètres!";
}