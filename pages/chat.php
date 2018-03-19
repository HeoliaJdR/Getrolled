<!-- <link rel="stylesheet" href="chat.css"/>!-->

<table id="body">

  <tr>
    <td id="titre"></td>
  </tr>

  <tr >

    <td style="height:500px">

      <div id="chat_aff" class="style1">
        <?php require "chat_vue.php"; ?>
      </div>
      <style type="text/css">
      .style1{
          width: 300px;
          height: 600px;
           
          /* le contenu n'est pas rogné */
          overflow: hidden;
          overflow: scroll;
          overflow: auto;
      }
        
      </style>
    </td>

  </tr>

  <tr >

    <td id="form" valign="top">

      <table id="form2">
        <tr>
          <td style="width:80%">
            <?php
              $bdd = connectDB();

              $query = $bdd->prepare("SELECT * FROM account WHERE token=:token");
              $query->execute( ["token"=>$_SESSION["token"]]);
              $resultat=$query->fetch();
            echo'
            <label for="name" id="nickname" style="font-family:Comic Sans MS;">'.$resultat["account_nickname"].'</label>';
            ?>
          </td>
          <td style="width:80%">
            
          </td>
          <td></td>

        </tr>
        <tr>
          <td>
            <label for="message" style="font-family:Comic Sans MS;">Message :</label><input id="message" type="text" maxlength="250"  />
          </td>

          <td>

            <input type="button" onclick='sendmessage()' value="envoyer">

          </td>
        </tr>

      </table>


    </td>

  </tr>

</table>
<script src="http://code.jquery.com/jquery.min.js"></script>
<script>

function myTimeoutFunction()
{
    showChat();
}

setInterval("myTimeoutFunction()", 100);

function AddZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}
function showChat(){
    var request = new XMLHttpRequest();
    request.open('POST', 'chat_vue.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function(){
      if(request.readyState == 4){
        if(request.status == 200){
          var parent = document.getElementById("chat_aff");
          parent.innerHTML=request.responseText;
        }
      }
  }
  request.send();
}
function sendmessage(){
  var request = new XMLHttpRequest();
  request.open('POST', 'chat_control.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function(){
    if(request.readyState == 4){
      if(request.status == 200){
        var parent = document.getElementById("chat_aff");
        var pseudo = document.getElementById("nickname").innerHTML;
        var now = new Date();
        var strDateTime = [[AddZero(now.getDate()), 
        AddZero(now.getMonth() + 1), 
        now.getFullYear()].join("/"), 
        [AddZero(now.getHours()), 
        AddZero(now.getMinutes())].join(":"), 
        now.getHours() >= 12 ? "PM" : "AM"].join(" ");
        parent.innerHTML+=strDateTime+pseudo+" : "+message;
        parent.scrollTop = parent.scrollHeight;
      }
    }
  }
  var message = document.getElementById("message").value;
  request.send('message=' + message);
}


</script>
