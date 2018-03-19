$('#envoi').click(function(e){
	e.preventDefault(); // on empeche d'envoyer le formulaire
	var pseudo = encodeURIComponent( $('#pseudo').val() );
	var message = encodeURIComponent( $('#message').val() );

	if (pseudo != "" && message != "") {
		$.ajax({
			url : "traitement.php",
			type : "POST",
			data : "pseudo=" + pseudo + "&message=" + message
			});
		$('#messages').append("<p> " + pseudo + " dit : " + message + "</p>");
	}
});
