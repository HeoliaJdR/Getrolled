<?php
if(isset($_POST["beginning"]) && isset($_POST["end"])){
    session_start();
}
require_once "functions.php";
require_once "conf.inc.php";
$db=connectDb();
$query = $db->prepare("SELECT * FROM account WHERE token=:token");
$query->execute( ["token"=>$_SESSION["token"]]);
$resultat=$query->fetch();
$query1 = $db->prepare("SELECT sender_nickname, content FROM comments WHERE profile_id=:id");
                                $query1->execute( ['id'=>$resultat[0]]);
                                $testcomment=false;
                                if(isset($_POST["beginning"]) && isset($_POST["end"])){
                                    $beginning=$_POST["beginning"];
                                    $end=$_POST["end"];
                                } else {
                                    $beginning=0;
                                    $end=5;
                                }
                                
                                $j=0;
                                while ($content = $query1->fetch()){
                                    $j++;
                                    if($j>=$beginning && $j<=$end){
                                        $queryavatar=$db->prepare("SELECT account_avatar FROM account WHERE account_nickname=:nickname");
                                        $queryavatar->execute(["nickname"=>$content[0]]);
                                        $avatar= $queryavatar->fetch();
                                        $testcomment=true;
                                        echo '<p class="list-group-item"> <a href="user_profile.php?user='.$content[0].'"><img src="'.$avatar[0].'" width="10%"/>'.$content[0].'</a> : '.$content[1].'</p>';
                                    }
                                }
                                if(!$testcomment){
                                    echo '<p class="list-group-item id="noComment""> Aucun commentaire! </p>';
                                }