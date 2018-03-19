<?php
	session_start();
	require "functions.php";
	require "conf.inc.php";
?>

<html>
<head>
	<title>Tchat Box</title>
    <meta CHARSET="UTF-8" />
</head>
<body>
	<div id="messages">
		<!--Ici seront afficher les messages du tchat-->
		<?php
			try {
			$bdd = new PDO("mysql:host=localhost;dbname=devhugo", 'root', '');
			} catch (Exception $e) {
			die("Erreur : ". $e->getMessage());
			}
			if (isset($_SESSION["token"])) {
				//On recup les 10 dernier messages
				$requete = $bdd->query('SELECT * FROM messages ORDER BY id DESC LIMIT 0,10');
				while ($donnees = $requete->fetch()) {
					echo "<p id=\"".$donnees['id']."\">".$donnees['auteur']." dit : ".$donnees['message']."</p>";
				}
				$requete->closeCursor();
		?>
	</div>
	<form method="POST" action="traitement.php">
		Message : <textarea name="message" id="message"></textarea><br>
		<input type="submit" name="submit" value="Envoyez votre message" id="envoi" />
	</form>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="../js/minichat.js"></script> -->
	<?php }?>
</body>
</html>