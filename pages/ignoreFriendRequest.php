<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

if(isset($_POST['sender_id']) && isset($_POST['receiver_id'])){
	$db= connectDb();
	$query = $db->prepare("UPDATE friendrequests SET is_ignored=1 WHERE receiver_id=:receiver_id AND sender_id=:sender_id");
    $query->execute(['receiver_id'=>$_POST["receiver_id"],
    				'sender_id'=>$_POST['sender_id']]);
} else {
	echo "erreur de paramètres!";
}