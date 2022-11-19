<?php
	require_once ("php_packages/input.php");
	
	$input = new input(inputType::search);
	$input->regex("[A-Za-z]{15}");
	$input->render();
?>
