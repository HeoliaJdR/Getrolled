<table id="table_message">
<?php
require_once"functions.php";
$bdd= connectDb();
$message=$bdd->prepare("SELECT * FROM globalchat_message");
$message->execute();
while($don = $message->fetch()) {
	echo $don["date"]."->".$don["pseudo"]." : ".$don["message"].'<br>';
}
?>
</table>
