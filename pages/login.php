<?php
    require_once "header.php";
    require_once "conf.inc.php";
?>
    <?php
        require "topMenu.php";

        $db = connectDb();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Connexion :</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            if(!empty($_SESSION["errors_form"])){
                                foreach ($_SESSION["errors_form"] as $errorquote){
                                    echo $listOfErrors[$errorquote]."<br>";
                                }
                            }
                        ?>
                        <form method="POST" action="testlogin.php" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Entrez votre E-mail" name="loginemail" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Entrez votre mot de passe" name="loginpwd" type="password">
                                </div>
                                <input type="submit" value="Se connecter">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

<?php
    require "footer.php";
?>
