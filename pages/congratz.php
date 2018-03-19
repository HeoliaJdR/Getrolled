<?php
session_start();
if(isset($_SESSION["token"])){
    require_once "header.php";
    require_once "functions.php";
    require_once "topMenu.php";
    require_once "menu.php";
    require_once "conf.inc.php";
} else {
    header("Location: accessdenied.php");
}
?>
        </nav>
<?php
    $db = connectDb();
    $query = $db->prepare("SELECT account_login FROM account WHERE token=:token");
    $query->execute( ["token"=>$_SESSION["token"]]);
    $resultat=$query->fetch();
?>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <?php
                            echo "Félicitation ".$resultat[0]." ! Vous êtes connecté!";
                        ?>
                    </div>
                </div>
            </div>                
        </div>

    <script src="../vendor/jquery/jquery.min.js"></script>

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
    <!-- refresh captcha -->
    <script src="../js/refresh.js">
<?php
    require_once "footer.php";
?>
