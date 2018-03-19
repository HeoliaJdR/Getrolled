<?php
session_start();
require_once "header.php";
require_once "topMenu.php";
require_once "menu.php";
require_once "functions.php";
require_once "conf.inc.php";
$db=connectDb();
$query = $db->prepare("SELECT * FROM account WHERE token=:token");
$query->execute(["token"=>$_SESSION["token"]]);
$resultat=$query->fetch();

$query1=$db->prepare("SELECT * FROM project WHERE project_owner=".$resultat[0]);
$query1->execute();
$project=$query1->fetch();
?>
</div>
            <div id="page-wrapper">
                        <div class="row">
                            <div class="col-lg-32">
                                <h1 class="page-header">Votre Projet :</h1>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php
                                        echo $project[1];
                                        $query2 = $db->prepare("SELECT * FROM project_inv WHERE project_inv_id=:id");
                                        $query2->execute(["id"=>$project[3]]);
                                    ?>
                                </div>
                                <div class="panel-body">
                                    <p class="list-group-item">
                                        Inventaires :
                                    </p>
                                    <div class="list-group-item">
                                    <p class="list-group-item">
                                        Sorts :
                                    </p>


                                        <?php
                                        $invents=$query2->fetch();
                                        $_SESSION['spellid']=$invents[1];
                                        $_SESSION['itemid']=$invents[2];
                                        $_SESSION['attributeid']=$invents[3];
                                        $queryspells=$db->prepare("SELECT * FROM project_inv_spell WHERE project_inv_spell_list_id=:id");
                                        $queryspells->execute(["id"=>$invents[1]]);
                                        echo'<table class="table" id="spellsParent">
                                        <tr>
                                            <td> nom </td>
                                            <td> description </td>
                                            <td> attribut1 </td>
                                            <td> description attribut 1</td>
                                            <td> attribut2 </td>
                                            <td> description attribut 2</td>
                                            <td> attribut3 </td>
                                            <td> description attribut 3</td>
                                            <td> degats/heal</td>
                                            <td> item requis </td>
                                        </tr>';
                                        $j=0;
                                        while($spells=$queryspells->fetch()){
                                            echo'<tr>';
                                            for($i=1;$i<11;$i++){
                                                $j++;
                                                echo'<td>'.$spells[$i].'</td>';
                                            }
                                            echo '<td onclick="deleteSpell('.$spells[0].','.$j.')">supprimer</td>';
                                            echo'</tr>';
                                        }
                                        echo'</table>';
                                        ?>
                                    </div>
                                    <div class="list-group-item">
                                        <p>Ajouter un sort:</p>
                                        <input type="text" id="spell_name" placeholder="nom du sort...">
                                        <input type="text" id="spell_desc"
                                        placeholder="description du sort...">
                                        <input type="text" id="attr1" placeholder="attribut 1">
                                        <input type="text" id="attr1_desc" placeholder="description de l'attribut 1">
                                        <input type="text" id="attr2" placeholder="attribut 2">
                                        <input type="text" id="attr2_desc" placeholder="description de l'attribut 2">
                                        <input type="text" id="attr3" placeholder="attribut 3">
                                        <input type="text" id="attr3_desc" placeholder="description de l'attribut 3">
                                        <input type="text" id="pr_inv_spell_attr_hot_dot" placeholder="dégats/heals">
                                        <input type="text" id="pr_inv_spell_req_item" placeholder="Entrez un item requis">
                                        <input type="button" value="Ajouter" onclick="addSpell()">
                                    </div>
                                    <div class="list-group-item">
                                    <p class="list-group-item">
                                        Items :
                                        <?php
                                        echo'<table class="table" id="itemsParent">
                                        <tr>
                                            <td> nom </td>
                                            <td> description </td>
                                            <td> attribut1 </td>
                                            <td> description attribut 1</td>
                                            <td> attribut2 </td>
                                            <td> description attribut 2</td>
                                            <td> attribut3 </td>
                                            <td> description attribut 3</td>
                                            <td> sort 1</td>
                                            <td> sort 2</td>
                                            <td> sort 3</td>
                                            <td> degats/heal</td>
                                            <td> item requis </td>
                                        </tr>';
                                        $queryitems=$db->prepare("SELECT * FROM project_inv_item WHERE project_inv_item_list_id=:id");
                                        $queryitems->execute(["id"=>$invents[2]]);
                                        $j=0;
                                        while($items=$queryitems->fetch()){
                                            echo'<tr id="item'.$j.'">';
                                            $j++;
                                            for($i=1;$i<14;$i++){
                                                echo'<td>'.$items[$i].'</td>';
                                            }
                                            echo '<td onclick="deleteItem('.$items[0].','.$j.')">supprimer</td>';
                                            echo'</tr>';
                                        }
                                        echo'</table>';
                                        ?>
                                    </p>
                                    <div class="list-group-item">
                                        <p>Ajouter un item:</p>
                                        <input type="text" id="item_name" placeholder="nom de l'item...">
                                        <input type="text" id="item_desc"
                                        placeholder="description de l'item...">
                                        <input type="text" id="item_attr1" placeholder="attribut 1">
                                        <input type="text" id="item_attr1_desc" placeholder="description de l'attribut 1">
                                        <input type="text" id="item_attr2" placeholder="attribut 2">
                                        <input type="text" id="item_attr2_desc" placeholder="description de l'attribut 2">
                                        <input type="text" id="item_attr3" placeholder="attribut 3">
                                        <input type="text" id="item_attr3_desc" placeholder="description de l'attribut 3">
                                        <input type="text" id="spell1" placeholder="Si votre item est lié à un sort ou plus">
                                        <input type="text" id="spell2" placeholder="Si votre item est lié à un sort ou plus">
                                        <input type="text" id="spell3" placeholder="Si votre item est lié à un sort ou plus"> 
                                        <input type="text" id="pr_inv_item_attr_hot_dot" placeholder="dégats/heals">
                                        <input type="button" value="Ajouter" onclick="addItem()">
                                    </div>
                                    </div>
                                    <div class="list-group-item">
                                    <p class="list-group-item">
                                        Attributs:
                                        <?php
                                        echo'<table class="table" id="attributesParent">
                                        <tr>
                                            <td> nom </td>
                                            <td> min </td>
                                            <td> max </td>
                                        <tr>';
                                        $queryattributes=$db->prepare("SELECT * FROM project_inv_attribute WHERE project_inv_attribute_list_id=:id");
                                            $queryattributes->execute(["id"=>$invents[3]]);
                                            while($attributes=$queryattributes->fetch()){
                                                echo'<tr>';
                                                for($i=1;$i<4;$i++){
                                                    if($attributes[$i]!=null){
                                                    echo'<td>'.$attributes[$i].'</td>';
                                                }
                                                }
                                                echo '<td onclick="deleteAttribute('.$attributes[0].')">supprimer</td>';
                                                echo'</tr>';
                                            }
                                            echo'</table>';
                                        ?>
                                    </p>
                                        <div class="list-group-item">
                                            <p>Ajouter un item:</p>
                                            <input type="text" id="attr_name" placeholder="nom de l'attribut...">
                                            <input type="text" id="min_val"
                                            placeholder="valeur min">
                                            <input type="text" id="max_val" placeholder="valeur max">
                                            <input type="button" value="Ajouter" onclick="addAttribute()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style type="text/css">
                                tr{
                                    tr {
                                        border: 1pt solid black;
                                    }
                                    table { 
                                        border-collapse: collapse; 
                                    }
                                }
                            </style>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="function.js"></script>
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
    require_once "footer.php";
?>