function addFriendForm(){
	var parent = document.getElementById("friendParent");
	var line = document.createElement("li");
	line.innerHTML = '<input type="text" id="friend_id" class="form-control" placeholder="Pseudo de l\'utilisateur"/><br><a onclick="sendRequest()">Envoyer la demande</a>'
	parent.appendChild(line);
}

function nicknameModify(){
	var nickname = document.getElementById("nickname");
	nickname.innerHTML = '<div class="panel-body"><input type="text" class="list-group-item" name="nicknameModifier" placeholder="Votre nouveau pseudo"></input></div>'
	+'<div class="panel-body"><input class="list-group-item" type="password" name="pwd" placeholder="Entrez votre mot de passe"></div></input>'
	+ '<div class="panel-body"><input type="submit" value="confirmer"></div>';
}

function emailModify(){
	var nickname = document.getElementById("email");
	nickname.innerHTML = '<div class="panel-body"><input type="email" class="list-group-item" name="emailModifier" placeholder="Votre nouvel email"></input></div>'
	+'<div class="panel-body"><input class="list-group-item" type="password" name="pwd" placeholder="Entrez votre mot de passe"></div></input>'
	+ '<div class="panel-body"><input type="submit" value="confirmer"></div>';
}

function birthdayModify(){
	var nickname = document.getElementById("birthday");
	nickname.innerHTML = '<div class="panel-body"><input type="date" class="list-group-item" name="birthdayModifier" placeholder="Modifiez votre date de naissance"></input></div>'
	+'<div class="panel-body"><input class="list-group-item" type="password" name="pwd" placeholder="Entrez votre mot de passe"></div></input>'
	+ '<div class="panel-body"><input type="submit" value="confirmer"></div>';
}

function loginModify(){
	var nickname = document.getElementById("login");
	nickname.innerHTML = '<div class="panel-body"><input type="text" class="list-group-item" name="loginModifier" placeholder="Votre nouvel identifiant"></input></div>'
	+'<div class="panel-body"><input class="list-group-item" type="password" name="pwd" placeholder="Entrez votre mot de passe"></div></input>'
	+ '<div class="panel-body"><input type="submit" value="confirmer"></div>';
}

function sendRequest(){
	var friendId = document.getElementById('friend_id').value;

	var request = new XMLHttpRequest();
	request.open('POST', 'createFriendRequest.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('friend_id=' + friendId);
}

function acceptFriendRequest(sender_id, receiver_id){

	var request = new XMLHttpRequest();
	request.open('POST', 'acceptFriendRequest.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var idLi = ""+receiver_id+sender_id;
				var idDivider = ""+receiver_id+sender_id+"1";
				var parent = document.getElementById("parent_notifs");
				var notif = document.getElementById(idLi);
				var divider = document.getElementById(idDivider);
				var friendParent=document.getElementById("friendParent");

				parent.removeChild(notif);
				parent.removeChild(divider);
				friendParent.innerHTML+='<li><a href="#"><i class="fa fa-circle-o fa-fw"></i>'+request.responseText+'<span class="fa arrow"></span></a> <ul class="nav nav-third-level"> <li><a href="user_profile.php?user='+request.responseText+'"><i class="fa fa-user fa-fw"></i>profil</a></li> <li><a onclick=deleteFriend(\'.$list[$i+1].\',\'.$account_id[0].\')><i class="fa fa-times fa-fw"></i>Supprimer</a></li>"';

			} else {
				console.error("nuuuu");
			}
		}
	}
}


function ignoreFriendRequest(sender_id, receiver_id){
	var request = new XMLHttpRequest();
	request.open('POST', 'ignoreFriendRequest.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('sender_id=' + sender_id + '&receiver_id='+receiver_id);

	var idLi = ""+receiver_id+sender_id;
	var idDivider = ""+receiver_id+sender_id+"1";
	var parent = document.getElementById("parent_notifs");
	var notif = document.getElementById(idLi);
	var divider = document.getElementById(idDivider);

	parent.removeChild(notif);
	parent.removeChild(divider);
}

function deleteFriend(delete_id, user_id){
	var request = new XMLHttpRequest();
	request.open('POST', 'deleteFriend.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('delete_id=' + delete_id + '&user_id='+user_id);

	var idLi = "friend"+delete_id+user_id;
	var parent = document.getElementById("friendParent");
	var notif = document.getElementById(idLi);

	parent.removeChild(notif);
}

function regeneratetoken(){
	var request = new XMLHttpRequest();
	request.open('POST', 'regenerateToken.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send("");
}
function sendComment(sender_nickname, receiver_id, is_profile, path, beginning, end, user){
	var request = new XMLHttpRequest();
	request.open('POST', 'sendComment.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				if(!user) showcomments(beginning,end,0);
				else showcomments(beginning,end,1);
			} else {
				console.error("nuuuu");
			}
		}
	}
	var content= document.getElementById("commentaire").value;
	request.send('sender_nickname=' + sender_nickname + '&receiver_id='+receiver_id+'&is_profile='+is_profile+'&content='+content);
}
function destroyNoComment(destroy){
	if(!destroy){
		var parent = document.getElementById("commentParent");
		var noComment= document.getElementById("noComment");

		parent.removeChild(noComment);
	}
}
function showtable(tablename, columnnb){
	var request = new XMLHttpRequest();
	request.open('POST', 'showtable.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var parent= document.getElementById("tableParent");
				var table= document.createElement("div");
				table.innerHTML=request.responseText;
				parent.appendChild(table);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('tablename=' + tablename + '&columnnb='+columnnb);
}
function showcomments(beginning,end,user){
	var request = new XMLHttpRequest();
	if(!user) request.open('POST', 'showcomments.php');
	else request.open('POST', 'showcomments_user.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var parent=document.getElementById("commentParent");
				parent.innerHTML=request.responseText;
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('beginning=' + beginning + '&end='+end);
}

function addpage(count, lastcount){
	if(count>=(lastcount+5)){
		var parent = document.getElementById("pagesParent");
		pagesParent.innerHTML+='<a onclick="showcomments('+(count+1)+','+(count+5)+')">'+(count/5+1)+'</a>'
	}
}
function reloadCaptcha(){
				var parent = document.getElementById("captcha");
				parent.setAttribute("src","captcha.php");
}

function addSpell(){
 	var request = new XMLHttpRequest();
	request.open('POST', 'addSpell.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var parent=document.getElementById("spellsParent");
				parent.innerHTML+="<tr><td>"+name+"</td>"+"<td>"+desc+"</td>"+"<td>"+attr1+"</td>"+"<td>"+descattr1+"</td>"+"<td>"+attr2+"</td>"+"<td>"+descattr2+"</td>"+"<td>"+attr3+"</td>"+"<td>"+descattr3+"</td>"+"<td>"+hotdot+"</td>"+"<td>"+reqitem+"</td><td onclick=\"deleteISpell('.$spells[0].','.$j.')\">supprimer</td></tr>";
			} else {
				console.error("nuuuu");
			}
		}
	}
	var name= document.getElementById("spell_name").value;
	var desc= document.getElementById("spell_desc").value;
	var attr1= document.getElementById("attr1").value;
	var descattr1= document.getElementById("attr1_desc").value;
	var attr2= document.getElementById("attr2").value;
	var descattr2= document.getElementById("attr2_desc").value;
	var attr3= document.getElementById("attr3").value;
	var descattr3= document.getElementById("attr3_desc").value;
	var hotdot= document.getElementById("pr_inv_spell_attr_hot_dot").value;
	var reqitem= document.getElementById("pr_inv_spell_req_item").value;

	request.send('name=' + name + '&desc='+desc + '&attr1=' + attr1 + '&descattr1='+ descattr1 + '&attr2=' + attr2 + '&descattr2='+ descattr2 + '&attr3=' + attr3 + '&descattr3='+ descattr3+'&hotdot='+hotdot+'&reqitem='+reqitem);
}

function addItem(){
 	var request = new XMLHttpRequest();
	request.open('POST', 'addItem.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var parent=document.getElementById("itemsParent");
				parent.innerHTML+="<tr><td>"+name+"</td>"+"<td>"+desc+"</td>"+"<td>"+attr1+"</td>"+"<td>"+descattr1+"</td>"+"<td>"+attr2+"</td>"+"<td>"+descattr2+"</td>"+"<td>"+attr3+"</td>"+"<td>"+descattr3+"</td>"+"<td>"+spell1+"</td>"+"<td>"+spell2+"</td>"+"<td>"+spell3+"</td>"+"<td>"+hotdot+"</td><td onclick=\"deleteItem('.$items[0].','.$j.')\">supprimer</td></tr>";
			} else {
				console.error("nuuuu");
			}
		}
	}
	var name= document.getElementById("item_name").value;
	var desc= document.getElementById("item_desc").value;
	var attr1= document.getElementById("item_attr1").value;
	var descattr1= document.getElementById("item_attr1_desc").value;
	var attr2= document.getElementById("item_attr2").value;
	var descattr2= document.getElementById("item_attr2_desc").value;
	var attr3= document.getElementById("item_attr3").value;
	var descattr3= document.getElementById("item_attr3_desc").value;
	var spell1=document.getElementById("spell1").value;
	var spell2=document.getElementById("spell2").value;
	var spell3=document.getElementById("spell3").value;
	var hotdot= document.getElementById("pr_inv_item_attr_hot_dot").value;

	request.send('name=' + name + '&desc='+ desc + '&attr1=' + attr1 + '&descattr1='+ descattr1 + '&attr2=' + attr2 + '&descattr2='+ descattr2 + '&attr3=' + attr3 + '&descattr3='+ descattr3 + '&spell1='+spell1+'&spell2='+spell2+'&spell3='+spell3+'&hotdot='+hotdot);
}

function addAttribute(){
 	var request = new XMLHttpRequest();
	request.open('POST', 'addAttribute.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var parent=document.getElementById("attributesParent");
				parent.innerHTML+="<tr><td>"+name+"</td>"+"<td>"+min+"</td>"+"<td>"+max+"</td><td onclick=\"deleteAttribute('.$attributes[0].','.$j.')\">supprimer</td></tr>";
			} else {
				console.error("nuuuu");
			}
		}
	}
	var name= document.getElementById("attr_name").value;
	var min= document.getElementById("min_val").value;
	var max= document.getElementById("max_val").value;

	request.send('name=' + name + '&min='+min+'&max='+max);
}

function deleteSpell(id, child){
	var request = new XMLHttpRequest();
	request.open('POST', 'deleteSpell.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var child = document.getElementById("spell"+child);
				var parent= document.getElementById("spellsParent");

				parent.removeChild(child);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('idspell='+id);
}

function deleteAttribute(id){
	var request = new XMLHttpRequest();
	request.open('POST', 'deleteSpell.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('idattribute='+id);
}

function deleteItem(id){
	var request = new XMLHttpRequest();
	request.open('POST', 'deleteSpell.php');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				console.log(request.responseText);
			} else {
				console.error("nuuuu");
			}
		}
	}
	request.send('iditem='+id);
}