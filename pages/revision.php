<?php

$nbATrouve = 12;
$cptChiffreTrouve = 0;
$start = 2;

while ($cptChiffreTrouve < $nbATrouve) {
	$isFirst = true;

	for ($i = 1; $i < $start; $i++) {
		if ($start == 1 || ($i != $start% $i == 0)){
			$isFirst = false;
			break;
		}
	}
	if($isFirst){
		$cptChiffreTrouve++;
		echo $start. "<br>";
	}
	$start++;
}