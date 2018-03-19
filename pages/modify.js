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
	var nickname = document.getElementById("nickname");
	nickname.innerHTML = '<div class="panel-body"><input type="text" class="list-group-item" name="loginModifier" placeholder="Votre nouvel identifiant"></input></div>'
	+'<div class="panel-body"><input class="list-group-item" type="password" name="pwd" placeholder="Entrez votre mot de passe"></div></input>'
	+ '<div class="panel-body"><input type="submit" value="confirmer"></div>';
}