<?php
	require("input.php");
	
	$input = [
				inputType::url,
				inputType::text,
				inputType::color,
				inputType::radio,
				inputType::checkbox];

	$in = new input(inputType::text,"cache");
	$in->iset("cache_in");
	$in->render();
	
	/*foreach($input as $key=>$inp) {
		$in = new input($inp,"input_$key");	
		#$in->iset("id_$key");

		$in->render();
	}*/
?>
