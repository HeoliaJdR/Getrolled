<!-- <link rel="stylesheet" href="chat.css"/> !-->
<?php
  session_start();
?>
<table id="body">
  <tr>
    <td style="height:500px">
      <div id="chat_aff">

      </div>
      <!--Contient les messages !-->
    </td>
  </tr>
  <tr >
    <td id="form" valign="top">
      <table id="form2">
        <tr>
          <td style="width:80%">
            <label for="name">Pseudo</label>
          </td>
          <td style="width:80%">
            <label for="message">Message</label>
          </td>
          <td></td>
        </tr>
        <tr>
          <td>
            <?php
              $db = connectDb();
              $connected = false;
              if(isset($_SESSION["token"])){
                $connected = true;
                $pseudo = $db->prepare("SELECT account_nickname FROM account WHERE token=:token");
                $pseudo->execute( ['account_nickname'=>$_SESSION["account_nickname"]]);
                $_SESSION["account_nickname"] = $pseudo->fetch();
                echo $_SESSION["account_nickname"];
              }
              else{
                echo "Vous n'êtes pas connecté.";
              }
            ?>
          </td>
          <td>
            <?php
              if($connected == true){
                echo '<input id="message" type="text" maxlength="250"  />';
                echo '
                  </td>
                  <td>
                    <button id="submit">Envoyer</button>
                  </td>';
              }
              else {
                echo " ";
              }
          ?>
        </tr>
      </table>
      <!--Contient le formulaire d'envoie !-->
    </td>
  </tr>
</table>
<script src="http://code.jquery.com/jquery.min.js"></script>
