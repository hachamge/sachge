<?php
	require("input.php");
	
	$input = [
				inputType::url,
				inputType::text,
				inputType::color,
				inputType::radio,
				inputType::checkbox];
		
	foreach($input as $key=>$inp) {
		$in = new input($inp,"input_$key");	
		$in->iset("id_$key");
		$in->disable();
		$in->multiple();
		$in->required();
		$in->render();
	}
?>
