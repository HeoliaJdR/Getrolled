<?php
    require_once "functions.php";
    require_once "conf.inc.php";
?>
<div id="wrapper">
 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Barre de navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="../logo.png" href="index.php">
                <a class="navbar-brand" href="index.php">
                    Get Roll'D
                </a>
            </div>
            <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                <?php
                if(isset($_SESSION["token"])){
                    $db= connectDb();
                    $query = $db->prepare("SELECT account_id FROM account WHERE token=:token");
                    $query->execute( ['token'=>$_SESSION["token"]]);
                    $account_id=$query->fetch();


                    

                    echo '
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>';
                    $querytest = $db->prepare("SELECT * FROM friendrequests WHERE receiver_id=:account_id AND is_accepted=0 AND is_ignored=0");
                    $querytest->execute( ['account_id'=>$account_id[0]]);

                    if($test = $querytest->fetch()){
                        echo '<!-- /.dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell faa-ring animated"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts" id="parent_notifs">
                                ';
                    } else {
                        echo '<!-- /.dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts" id="parent_notifs">
                                ';
                    }
                                $query1 = $db->prepare("SELECT * FROM friendrequests WHERE receiver_id=:account_id AND is_accepted=0 AND is_ignored=0");
                                $query1->execute( ['account_id'=>$account_id[0]]);
                                $testnotif=false;
                                    while ($donnees = $query1->fetch()){
                                        $testnotif=true;
                                        $query3 = $db->prepare("SELECT account_nickname FROM account WHERE account_id=".$donnees["sender_id"]."");
                                        $query3->execute();
                                        $account_nick=$query3->fetch();
                                        echo '<li id="'.$account_id[0].$donnees['sender_id'].'"><a><i class="fa fa-bell fa-fw"></i>'.$account_nick['account_nickname'].' vous a envoyé une demande!<a onclick="acceptFriendRequest('.$donnees['sender_id'].','.$account_id[0].')"><i class="fa fa-check fa-fw"></i>accepter</a><a onclick="ignoreFriendRequest('.$donnees['sender_id'].','.$account_id[0].')"><i class="fa fa-times fa-fw"></i>ignorer</a></li>';
                                        echo '<li id="'.$account_id[0].$donnees['sender_id'].'1" class="divider"></li>';
                                    }
                                    if(!$testnotif){
                                        echo "<li><center>Pas de notifications</center></li>";
                                    }
                            echo '</li>
                            
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>';
                }
                ?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <?php
                        if(isset($_SESSION["token"])){
                        echo '<li><a href="profil.php"><i class="fa fa-user fa-fw"></i> Profil</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Options</a>
                            </li>
                            <li><a href="stop.php"><i class="fa fa-toggle-on fa-fw"></i> Se déconnecter</a>
                            </li>';
                            $db=connectDb();
                            $query2 = $db->prepare("SELECT is_admin FROM account WHERE token=:token");
                            $query2 -> execute(["token"=>$_SESSION["token"]]);
                            $admin=$query2->fetch();
                            if($admin[0]==1){
                                echo '<li><a href="admin.php"><i class="fa fa-user fa-fw"></i> Administration</a></li>';
                            }
                        } else {
                            echo '<li><a href="login.php"><i class="fa fa-toggle-off fa-fw"></i> Se connecter</a>
                            <li><a href="signup.php"><i class="fa fa-sign-out fa-fw"></i> S\'inscrire</a>
                            </li>
                        </li>';
                        }
                    ?>
                    <script src="function.js"></script>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>