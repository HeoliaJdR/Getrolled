<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <?php
                            if(isset($_SESSION["token"])){
                                $db= connectDb();
                                $query = $db->prepare("SELECT account_id FROM account WHERE token=:token");
                                $query->execute( ['token'=>$_SESSION["token"]]);
                                $account_id=$query->fetch();

                                echo '
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Menu</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-beer fa-fw"></i> Amis<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" id="friendParent">
                                ';
                                        $query1 = $db->prepare("SELECT * FROM friendlists WHERE user_id=:account_id");
                                        $query1->execute( ['account_id'=>$account_id[0]]);
                                        $list = $query1 -> fetch();

                                $i=1;
                                while($list[$i]){
                                    $query2 = $db->prepare("SELECT account_nickname,token FROM account WHERE account_id=".$list[$i]);
                                    $query2->execute();
                                    $nickname = $query2 -> fetch();
                                    if($nickname[1]){
                                        echo '<li id="friend'.$list[$i].$account_id[0].'"><a href="#"><i class="fa fa-circle fa-fw"></i>'.$nickname[0].'<span class="fa arrow"></span></a>';
                                    } else {
                                        echo '<li id="friend'.$list[$i].$account_id[0].'"><a href="#"><i class="fa fa-circle-o fa-fw"></i>'.$nickname[0].'<span class="fa arrow"></span></a>';
                                    }
                                        echo '<ul class="nav nav-third-level">
                                            <li><a href="user_profile.php?user='.$nickname[0].'"><i class="fa fa-user fa-fw"></i>profil</a></li>
                                            <li><a onclick=deleteFriend('.$list[$i].','.$account_id[0].')><i class="fa fa-times fa-fw"></i>Supprimer</a></li>
                                        </ul>';
                                    $i++;
                                    }
                                    echo '


                                </li>
                                <li>
                                    <a onclick="addFriendForm()">Ajouter un ami</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Gerer projets<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="my_project.php">Créer un projet</a>
                                </li>
                                <li>
                                    <a href="del_my_project.php" onclik="del_project(this_href); return(false);">Supprimer un projet</a>
                                </li>
                                <li>
                                    <a href="modify_project.php">Modifier un projet</a>
                                </li>
                                <li>
                                    <a href="administrate_project.php">Administrer un projet</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Liste des projets<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Projet 1<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="perso1.php">Perso 1</a>
                                        </li>
                                        <li>
                                            <a href="perso2.php">Perso 2</a>
                                        </li>
                                        <li>
                                            <a href="perso3.php">Perso 3</a>
                                        </li>
                                        <li>
                                            <a href="project1.php">Infos du projet</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Projet 2<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Perso 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Perso 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Perso 3</a>
                                        </li>
                                        <li>
                                            <a href="project2.php">Infos du projet</a>
                                        </li>
                                    </ul>
                               </li>
                                <li>
                                    <a href="#">Projet 3<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Perso 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Perso 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Perso 3</a>
                                        </li>
                                        <li>
                                            <a href="project.php">Infos du projet</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>';
                    }
                        ?>
                        <li>
                            <a href="forms.php"><i class="fa fa-edit fa-fw"></i> Support</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Nous contacter<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.php">Reseaux sociaux</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <script src="function.js"></script>
