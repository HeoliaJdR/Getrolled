<?php
    require "header.php";
?>
    <?php
        require "topMenu.php";
    ?>
        <!-- /.navbar-top-links -->
        <?php
            require "menu.php";
        ?>
        </nav>
    <?php
            require_once "conf.inc.php";
            if(!empty($_SESSION["errors_form"])){
                $data = $_SESSION["data_form"];
            }
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(!empty($_SESSION["errors_form"])){
                                    foreach ($_SESSION["errors_form"] as $errorquote){
                                        echo $listOfErrors[$errorquote]."<br>";
                                    }
                                    $data = $_SESSION["data_form"];
                                }
                            ?>
                            <form method="POST" action="saveUser.php">
                                <fieldset>
                                    <div class="form-group">
                                        Votre email* : <input type="email" required="required" placeholder="Format ****@****.com" name="email" value="<?php echo(isset($data['email']))?$data['email']:'' ;?>">
                                    </div>
                                    <div class="form-group">
                                        Votre mot de passe* : <input type="password" required="required" placeholder="8 à 24 caractères" name="pwd">
                                    </div>
                                    <div class="form-group">
                                        Confirmation mdp* : <input type="password" required="required" placeholder="Confirmez" name="pwd2">
                                    </div>
                                    <div class="form-group">
                                        Votre identifiant* : <input type="text*" required="required" placeholder="3 caractères min" name="connect_id" value="<?php echo(isset($data['connect_id']))?$data['connect_id']:'' ;?>">
                                    </div>
                                    <div class="form-group">
                                        Votre pseudo* : <input type="text*" required="required" placeholder="3 caractères min" name="nickname" value="<?php echo(isset($data['nickname']))?$data['nickname']:'' ;?>">
                                    </div>
                                    <div class="form-group">
                                        Date de naissance : <br><input type="date" name="birthday">
                                    </div>
                                    <div class="form-group">
                                        <label><a>CGU</a></label> <input type="checkbox" name="legacy" required="required">
                                    </div>
                                    <div class="form-group">
                                        <img id="captcha" src="captcha.php">
                                        <input type="button" onclick="reloadCaptcha()" value="changer de captcha">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="captcha" placeholder="Veuillez saisir le captcha" required="required">
                                    </div>
                                    <input type="submit" value="S'inscrire" class="btn btn-lg btn-success btn-block">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="function.js"></script>
    <!-- jQuery -->
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
<?php
    require "footer.php";
?>
