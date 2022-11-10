<?php
	require("input.php");
	
	$out = new input(inputType::label);
	$out->setLabelFor("helpful");
	$out->innerHtmlForLabel("helpful");
	$out->render();
?>
