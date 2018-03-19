<?php
    require "header.php";
    session_start();
?>

    <?php
        require "topMenu.php";
        require "menu.php";
    ?>
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mon projet</h1>
                </div>
                <!-- /.col-lg-12 -->
                <?php
                  $db = connectDb();
                  $prj_own_id = $db->prepare('SELECT project_id FROM project WHERE project_owner='.$_SESSION["account_id"]);
                  $prj_own_id->execute();
                  $testj=$prj_own_id->fetch();
                  $_SESSION["project_owned"] = $testj[0];

                  if (!isset($testj[0])) {
                    echo
                      "<div id='project-create'>
                        <div class='col-lg-12'>
                          <form method='POST' action='create_project.php'>
                            <fieldset>
                                <div class='form-group'>
                                    Nom du projet* : <input type='text' required='required' placeholder='Mon projet (3 car. min)' name='nameproject'>
                                </div>
                                <div class='form-group'>
                                    Nombres d'attributs* : <input type='number' required='required' placeholder='1-20' name='number_attri'>
                                    <br>
                                    <div>
                                      * Les attributs sont les HP, MANA, Psychée/Mental, Physique, Social/Charisme etc... tout ce qui sera utile à la gestion de vos stats dans votre Jeu de Rôle.
                                    </div>
                                </div>
                                <input type='submit' value='Créer' class='btn btn-lg btn-success btn-block'>
                            </fieldset>
                          </form>
                        </div>
                      </div>";
                  }
                  else {
                    echo
                      "<div class='form-group'>
                          Vous avez déjà un projet.
                          <br>
                          <a href='index.php'>
                            <input type='button' value='Quitter la page' class='btn btn-lg btn-success btn-block'/>
                          </a>
                      </div>";
                  }
                ?>
            </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

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
