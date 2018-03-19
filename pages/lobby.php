<?php
    require "header.php";
    session_start();
?>

    <?php
        require "topMenu.php";
        require "menu.php";
        require_once "functions.php";
        require_once "conf.inc.php";
        $db = connectDb();
    ?>
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      <?php
                        $search_char = $db->prepare("SELECT characters_name FROM characters WHERE characters_project=".$_SESSION["first_project"]);
                        $search_char->execute();
                        $search_char_result=$search_char->fetchAll();
                        showArray($_SESSION);
                        showArray($search_char_result);
                      ?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <form method="POST" action="lobby_action.php">
                  <div class='col-md-6'>
                    Votre personnage :
                      <select name="you">
                        <?php
                          foreach ($search_char_result as $key => $value) {
                            echo '<option name="attaque" value="'.$key.'" ';
                    				echo ($search_char_result == $key)?'selected="selected"':'';
                    				echo '>'.$value[0].'</option>';
                          }


                        ?>
                      </select>
                  </div>
                  <div class='col-md-6'>
                    Votre cible :
                      <select name="target">
                        <?php
                          foreach ($search_char_result as $key => $value) {
                            echo '<option name="defense" value="'.$key.'" ';
                    				echo ($search_char_result == $key)?'selected="selected"':'';
                    				echo '>'.$value[0].'</option>';
                          }
                        ?>
                      </select>
                  </div>
                  <br>
                  <div class='col-lg-12'>
                      <input type='submit' value='Action' class='btn btn-lg btn-success btn-block'/>
                  </div>
                </form>
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
