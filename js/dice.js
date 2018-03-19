function rolldice() {
	var nbdice1 = document.form_dice.nbdice1.value;
	var dice1 = document.form_dice.dice1.value;
	var resdice;
	if(nbdice1 != 0 || nbdice1 != 0) {
		resdice = Math.floor((Math.random() * dice1) + 1 ) * nbdice1;
		alert("Dé de base "+dice1+" à  été jeté "+nbdice1+" fois"+" ; resultat du jet "+resdice);
	}
	else {
		resdice = Math.floor((Math.random() * dice1) + 1 );
		alert("Dé de base "+dice1+" à  été jeté 1 fois"+" ; resultat du jet "+resdice);
	}
}