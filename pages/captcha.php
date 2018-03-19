<?php
session_start();

//Creation d'une image vierge
$image = imagecreate(200, 100);

$red=rand(0,255);
$green=rand(0,255);
$blue=rand(0,255);

$bg = imagecolorallocate($image, $red, $green, $blue);
$color = imagecolorallocate($image, 255-$red, 255-$green, 255-$blue);

//Créer une chaine aléatoire de chiffre et de lettres d'une longueur aléatoire (entre 5 et 10)

$char = 'abcdefghijklmnopqrstuvwxyz0123456789';
$captcha = str_shuffle($char);
$numb = rand ( 4 , 6 );
$captcha = substr($captcha, 0, $numb);
$_SESSION["captcha"] = strtolower($captcha);

//imagestring($image, $font, 150, 80, $captcha , $white);

$listOfFonts = glob("../fonts/*.ttf");
shuffle($listOfFonts);
$font = $listOfFonts[0];
$angle = rand(-20,20);

imagettftext($image, 30, $angle, 75, 40, $color, $font, $captcha);
for($i=0;$i<3; $i++){
	ImageLine ($image, rand(0,200), rand(0,100), rand(0,200), rand(0,100), $color);
	ImageRectangle ($image, rand(0,100), rand(0,50), rand(100,200), rand(50,100), $color);
	ImageEllipse ($image, rand(0,200), rand(0,100), rand(10,100), rand(10,100), $color);
}

//Affichage de l'image finale
imagepng($image);