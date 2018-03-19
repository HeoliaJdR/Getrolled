<?php
    session_start();
    require "header.php";
    require_once "functions.php";
    require_once "conf.inc.php";
    $db = connectDb();
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
                    <h1 class="page-header">Personnage 1</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div id="project-create">
                  <div class="col-lg-12">
                    <form method="POST" action="new_character.php">
                      <fieldset>
                          <div class="form-group">
                              Nom du personnage* : <input type="text" required="required" placeholder="Jean Michel Crapeau" name="char_name" value="">
                          </div>
                          <?php
                            showArray($_SESSION);
                            $attribute_id = $db->prepare('SELECT account_first_project FROM account WHERE account_mail='.$_SESSION['email']."'");
                            $attribute_id->execute();
                            $res_attribute_id=$attribute_id->fetch();
                            showArray($res_attribute_id);

                            $nb_attribute = $db->prepare('SELECT COUNT(*) FROM project_inv_attribute WHERE project_inv_attribute_list_id='.$res_attribute_id);
                            $nb_attribute->execute();
                            $res_attribute=$nb_attribute->fetch();
                            showArray($res_attribute);
                            /*foreach ($res_attribute as $key => $value) {
                              echo '<inpute type=text'
                            }*/

                          ?>
                          <input type="submit" value="Créer" class="btn btn-lg btn-success btn-block">
                      </fieldset>
                    </form>
                  </div>
                </div>
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
