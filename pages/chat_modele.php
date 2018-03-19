<?php
session_start();
require_once "functions.php";


function ajout_message($bdd,$message)
{
  $bdd = connectDB();

  $query = $bdd->prepare("SELECT * FROM account WHERE token=:token");
  $query->execute( ["token"=>$_SESSION["token"]]);
  $resultat=$query->fetch();
  $today = date("Y-m-d H:i:s"); 
  $req = $bdd->prepare("INSERT INTO globalchat_message(pseudo, message, date) VALUES(:pseudo, :message, :date)");
  $req->execute(array("pseudo"=>$resultat["account_nickname"],"message"=>$message, "date"=>$today));
  echo "oui";
}

function message($bdd)
{
  $req = $bdd->prepare("SELECT * FROM globalchat_message ORDER BY Date DESC");
  $req->execute();

  $req= $req->fetch();

  return $req;
}

function expire_message($bdd)
{

  $req = $bdd->prepare("DELETE FROM globalchat_message WHERE Date < DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
  $req ->execute();

}

function pair($nombre)
{
  if ($nombre%2 == 0) return true;
  else return false;
}

function getRelativeTime($date) {
  // Déduction de la date donnée à la date actuelle
  $time = time() - strtotime($date);

  // Calcule si le temps est passé ou à venir
  if ($time > 0) {
    $when = "il y a";
  } else if ($time < 0) {
    $when = "dans environ";
  } else {
    return "il y a 1 seconde";
  }
  $time = abs($time);

  // Tableau des unités et de leurs valeurs en secondes
  $times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes
  2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes
  86400    =>  'jour{s}',     // 24 * 60 * 60 secondes
  3600     =>  'heure{s}',    // 60 * 60 secondes
  60       =>  'minute{s}',   // 60 secondes
  1        =>  'seconde{s}'); // 1 seconde

  foreach ($times as $seconds => $unit) {
    // Calcule le delta entre le temps et l'unité donnée
    $delta = round($time / $seconds);

    // Si le delta est supérieur à 1
    if ($delta >= 1) {
      // L'unité est au singulier ou au pluriel ?
      if ($delta == 1) {
        $unit = str_replace('{s}', '', $unit);
      } else {
        $unit = str_replace('{s}', 's', $unit);
      }
      // Retourne la chaine adéquate
      return $when." ".$delta." ".$unit;
    }
  }
}
?>
