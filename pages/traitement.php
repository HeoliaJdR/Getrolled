<?php
session_start();


$bdd = connectDb();

if (isset($_POST['submit'])) { //Si des données sont envoyées
	if (!empty($_POST['auteur']) && !empty($_POST['message'])) { // si les variables no sont pas vides
		$query = $bdd->prepare('INSERT INTO messages (auteur,message) VALUES(:auteur, :message)');
		$query->execute([
							'auteur' => $_POST['auteur'],
							'message' => $_POST['message']
						]);
	header('Location: minichat.php');
	}else{
		echo "Erreur dans le formulaire";
	}
}
