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
                <h1 class="page-header">Validé !</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class='form-group'>
                  Votre projet est supprimé.
                  <br>
                  <a href='index.php'>
                    <input type='button' value='Quitter la page' class='btn btn-lg btn-success btn-block'/>
                  </a>
                </div>";
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
