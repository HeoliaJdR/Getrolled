<?php
session_start();
require_once "functions.php";
require_once "conf.inc.php";

if(isset($_POST['friend_id'])){
	$db= connectDb();
	$query = $db->prepare("SELECT account_id FROM account WHERE token=:token");
    $query->execute( ['token'=>$_SESSION["token"]]);
    $resultat=$query->fetch();

    echo $resultat[0]." ";
    echo $_POST["friend_id"]." ";

    $query1 = $db->prepare("SELECT account_id FROM account WHERE account_nickname=:friend_id");
    $query1->execute( ['friend_id' => $_POST["friend_id"]]);
    $receiver_id=$query1->fetch();

    print_r($receiver_id);

    $today = date("Y-m-d H:i:s"); 

    echo $today;

	$query2 = $db->prepare('INSERT INTO friendrequests(sender_id, receiver_id, request_date)VALUES(:sender_id, :receiver_id, :request_date)');
	if($query2 != NULL){
		$query2->execute(array(
				'sender_id' => $resultat[0],
				'receiver_id' => $receiver_id[0],
				'request_date' => $today
				));
	} else {
		echo 'nope';
	}
} else {
	echo "Il faut mettre des paramètres!";
}