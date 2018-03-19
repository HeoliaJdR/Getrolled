<?php
	session_start();
	require_once "header.php";
	require_once "functions.php";
	require_once "conf.inc.php";
	$db=connectDb();
	$query2 = $db->prepare("SELECT is_admin FROM account WHERE token=:token");
	$query2 -> execute(["token"=>$_SESSION["token"]]);
	$admin=$query2->fetch();

	if($admin[0]!=1){
		header("Location: accessdenied.php");
	}

	$query1 = $db->prepare("SELECT MAX(account_id) FROM account");
	$query1 -> execute();
	$max=$query1->fetch();
?>
	utilisateurs : <br>
	<table>
		<tr>
			<td> account_id </td>
			<td> account_login </td>
			<td> account_nickname </td>
			<td> account_pwd </td>
			<td> account_mail </td>
			<td> account_friend_list </td>
			<td> account_active </td>
			<td> account_age </td>
			<td> account_creation_date </td>
			<td> account_first_project </td>
			<td> account_second_project </td>
			<td> account_third_project </td>
			<td> account_last_ip </td>
			<td> token </td>
			<td> is_admin </td>
		</tr>
<?php
	for($i=1; $i <= $max[0];$i++){
	    $query = $db->prepare("SELECT * FROM account WHERE account_id=".$i."");
	    $query->execute();
	    $resultat=$query->fetch();
	    echo "<tr>";
		for($j = 0; $j <= 14; $j++){
			if($resultat[$j]==NULL){
				echo "<td>NULL</td>";
			} else {
				echo "<td>".$resultat[$j]."</td>";
			}
		}
		echo "</tr>";
	}
?>
	</table>
	<br>
	<p> autres tables :</p>
	<button onclick=showtable('characters',4)> characters </button>
	<button onclick=showtable('chat_annonce',1)> chat_annonce </button>
	<button onclick=showtable('chat_messages',3)> chat_messages </button>
	<button onclick=showtable('chat_online',4)> chat_online </button>
	<button onclick=showtable('comments',5)> comments </button>
	<button onclick=showtable('friendlists',20)> friendlists </button>
	<button onclick=showtable('friendrequests',4)> friendrequests </button>
	<button onclick=showtable('project',3)> project </button>
	<button onclick=showtable('project_inv',3)> project_inv </button>
	<button onclick=showtable('project_inv_attribute',4)> project_inv_attribute </button>
	<button onclick=showtable('project_inv_attribute_list',0)> project_inv_attribute_list </button>
	<button onclick=showtable('project_inv_item',15)> project_inv_item </button>
	<button onclick=showtable('project_inv_item_list',0)> project_inv_item_list </button>
	<button onclick=showtable('project_inv_spell',13)> project_inv_spell </button>
	<button onclick=showtable('project_inv_spell_list',0)> project_inv_spell_list </button>
	<button onclick=showtable('project__player_list',2)> project_player_list </button>
	<div id="tableParent"></div>
	<p> bannir un utilisateur : </p>
	<form method="POST" action="ban.php">
		<input type="text" name ="nickname" placeholder="entrez le pseudo de l'utilisateur à bannir">
		<input type="submit" value="bannir">
	</form>
	<br>
	<p> débannir un utilisateur : </p>
	<form method="POST" action="unban.php">
		<input type="text" name ="nickname" placeholder="entrez le pseudo de l'utilisateur à débannir">
		<input type="submit" value="débannir">
	</form>
	<br>
	<p> rendre un utilisateur administrateur : </p>
	<form method="POST" action="op.php">
		<input type="text" name ="nickname" placeholder="entrez le pseudo de l'utilisateur à promouvoir">
		<input type="submit" value="promouvoir">
	</form>
	<a href="index.php"> retour au site </a>
<style type="text/css">
	td {
		border:1px solid black;
	}
</style>
<script src="function.js"></script>
<?php
	require "footer.php";