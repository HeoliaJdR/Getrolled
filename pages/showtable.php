<?php
	session_start();
	require_once "functions.php";
	require_once "conf.inc.php";
	echo'<table>';
	$db=connectDb();
	$queryname = $db -> prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$_POST["tablename"]."'");
	$queryname -> execute();
	while($name=$queryname->fetch()){
		echo "<td>".$name[0]."</td>";
	}
	$query = $db->prepare("SELECT * FROM ".$_POST["tablename"]);
	$query->execute();
    while($resultat=$query->fetch()){
	    echo "<tr>";
		for($j = 0; $j <= $_POST["columnnb"]; $j++){
			if($resultat[$j]==NULL){
				echo "<td>NULL</td>";
			} else {
				echo "<td>".$resultat[$j]."</td>";
			}
		}
			echo "</td>";
	}
	echo'</table>';
