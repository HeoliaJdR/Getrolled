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
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mon projet</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div id="project-create">
                  <div class="col-lg-2">
                    <form method="POST" action="create_project.php">
                      <fieldset>
                          <div class="form-group">
                              Nom du projet* : <input type="text" required="required" placeholder="Mon projet" name="nameproject" value="">
                          </div>
                          <input type="submit" value="S'inscrire" class="btn btn-lg btn-success btn-block">
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
