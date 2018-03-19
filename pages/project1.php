<?php
  session_start();
    require "header.php";
        $_SESSION["project_nb"] = 1;
?>

    <?php
        require "topMenu.php";
        require "menu.php";
    ?>
            <!-- /.navbar-static-side -->
        </nav>
        <?php
        if (isset($_SESSION['email'])) {
          $db = connectDb();
          $inProject=$db->prepare('SELECT account_first_project FROM account WHERE account_mail=:email');
          $inProject->execute(["email"=>$_SESSION["email"]]);
          $isInProject=$inProject->fetch();
          if(!isset($isInProject[0])) {

            echo '<div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Rejoindre le Projet 1</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div id="join-project">
                          <div class="col-lg-12">
                            <form method="POST" action="join_project.php">
                              <fieldset>
                                  <div class="form-group">
                                      ID du projet* : <input type="text" required="required" placeholder="ID" name="project_id" value="">
                                  </div>
                                  <input type="submit" value="Rejoindre" class="btn btn-lg btn-success btn-block">
                              </fieldset>
                            </form>
                          </div>
                        </div>
                    </div>  
                <!-- /#page-wrapper -->
                </div>';
              }
              else {
                echo '<div id="page-wrapper">
                        <div class="row">
                          <div class="col-lg-12">';
                       echo '<h1> Projet : "';
          $inProject=$db->prepare('SELECT project_name FROM project WHERE project_id=:project_id');
          $inProject->execute(["project_id"=>$isInProject[0]]);
          $isInProject2=$inProject->fetch();
                       echo $isInProject2[0];
                       echo '"</h1>';

                       echo '<h2> Créer par : "';
          $inProject=$db->prepare('SELECT project_owner FROM project WHERE project_id=:project_id');
          $inProject->execute(["project_id"=>$isInProject[0]]);
          $projectOwn=$inProject->fetch();
          $inProject=$db->prepare('SELECT account_nickname FROM account WHERE account_id=:account_id');
          $inProject->execute(["account_id"=>$projectOwn[0]]);
          $isInProjectown=$inProject->fetch();
                       echo $isInProjectown[0];
                       echo '"</h2>';

                       echo '<h2>ID du projet : "';
                       echo $isInProject[0];
                       echo '"</h2></div>
                      </div><h4>';
          $inProject=$db->prepare('SELECT * FROM project_inv_attribute WHERE project_inv_attribute_list_id=:project_inv_attribute_list_id');
          $inProject->execute(["project_inv_attribute_list_id"=>$isInProject[0]]);
          $i = 1;
          while ($isInProject3=$inProject->fetch() ) {
            echo '<h4>Attribut '.$i.' " '.$isInProject3['pr_inv_attr_name'].'</h4>  Min : '.$isInProject3['pr_inv_attr_min_val'].',  Max : '.$isInProject3['pr_inv_attr_max_val'].'"<br><br>';
          $i = $i + 1;
        }

        echo '<h2> Membres du projet : "';
          $inProject=$db->prepare('SELECT account_nickname FROM account WHERE account_first_project=:account_first_project');
          $inProject->execute(["account_first_project"=>$isInProject[0]]);
          $i = 1;
          while ($isInProject4=$inProject->fetch() ) {
            echo $i.'. '.$isInProject4['account_nickname'].' \ ';
          $i = $i + 1;
        }
                       echo '"</h2>';
        echo '<div id="quit-project">
                          <div class="col-lg-12">
                            <form method="POST" action="quit_project.php">
                              <fieldset>
                                  <input type="submit" value="Quitter le projet" class="btn btn-lg btn-success btn-block">
                              </fieldset>
                            </form>
                          </div>
                        </div>
                      </div>';  
              }
            }else{
              echo '<div id="page-wrapper">
                        <div class="row">
                          <div class="col-lg-12">
                            <h1> Tes pas connecter</h1>
                          </div>
                        </div>
                      </div>';
            }
        ?>
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
