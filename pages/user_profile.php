<?php
session_start();
            if(isset($_SESSION["token"])){
                require_once "header.php";
                require_once "topMenu.php";
                require_once "menu.php";
                require_once "functions.php";
                require_once "conf.inc.php";
                $db=connectDb();
                $user= $_GET["user"];
                $_SESSION["user_profile"]=$user;
                $query = $db->prepare("SELECT * FROM account WHERE account_nickname=?");
                $query->execute( array($user));
                $resultat=$query->fetch();

                $query2 = $db->prepare("SELECT account_nickname FROM account WHERE token=:token");
                $query2->execute(["token"=>$_SESSION["token"]]);
                $sender_nickname=$query2->fetch();

                if(!isset($_SESSION['pwderror'])){
                    $_SESSION['pwderror']=3;
                }
                echo'
                </nav>

                    <div id="page-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Profil</h1>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Avatar :
                                    </div>
                                <center><img src="'.$resultat["account_avatar"].'" width="90%"/></center>
                            </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Informations du compte :
                                    </div>
                                    <div class="panel-body">';
                                            echo($_SESSION['pwderror']==1)?'<p class="list-group-item">Mot de passe incorrect!</p><br>':'';
                                            echo '<p class="list-group-item">Pseudo :'.$resultat[2].'</p>
                                            <p class="list-group-item">identifiant :'.$resultat[1].'</p>
                                            <p class="list-group-item">Adresse mail :'.$resultat[4].'</p>
                                            <p class="list-group-item">Date de naissance :'.$resultat[8].'</p>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                    </div>
                                </div>

                        <div class="col-lg-4">
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                Commentaires:
                            </div>
                            <div class="panel-body" id="commentParent">';
                                require"showcomments_user.php";
                                echo '
                            </div>
                            <div class="panel-body">
                                <p class="list-group-item" id=pagesParent> Pages : ';
                                $query1 = $db->prepare("SELECT sender_nickname, content FROM comments WHERE profile_id=:id");
                                $query1->execute( ['id'=>$resultat[0]]);
                                $count=0;
                                $lastcount=0;
                                $page=1;

                                while($test= $query1->fetch()){
                                    if($count%5==0){
                                        echo ' <a onclick="showcomments('.($count+1).','.($count+5).',1)">'.$page.'</a> ';
                                        $page++;
                                        $lastcount=$count;
                                    }
                                    $count++;
                                }
                                echo'
                                </p>
                            </div>
                            <div class="panel-heading">
                                Ajoutez un commentaire:
                            </div>
                            <div class="panel-body">
                                <div class="list-group-item">
                                    <textarea id="commentaire" type="text" required="required"></textarea></div>
                                </div>
                                <div class="list-group-item">';
                                echo'
                                    <input type="button" value="Envoyer" onclick="sendComment(\''.$sender_nickname[0].'\','.$resultat[0].',1,\''.$resultat["account_avatar"].'\','.($lastcount+1).','.($lastcount+5).',1), destroyNoComment('.$testcomment.'), addpage('.$count.','.$lastcount.')"/>
                                </div>
                            </div>
                                        </div>
                                    </div>
                            </div>';
            } else {
                header("Location: accessdenied.php");
            }
        ?>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="function.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<?php
    require_once "footer.php";
?>
