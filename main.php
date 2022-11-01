<?php
	require("input.php");
	
	$input = [
				inputType::url,
				inputType::text,
				inputType::color,
				inputType::radio,
				inputType::checkbox];

	$in = new input(inputType::file,"cache");
	$in->iset("∫1");
	$in->min(2);
	$in->autocomplete();
	$in->render();
	
	/*foreach($input as $key=>$inp) {
		$in = new input($inp,"input_$key");	
		#$in->iset("id_$key");

		$in->render();
	}*/
?>
