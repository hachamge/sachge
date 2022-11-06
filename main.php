<?php
	require("input.php");

/*
	$input = [
				inputType::url,
				inputType::text,
				inputType::color,
				inputType::radio,
				inputType::checkbox];
*/

	$iframe = new iframe("http://Etz Hayim.com/");
	//$iframe->sandbox();
	$iframe->scroll(true);
	//$iframe->frameBorder();
	$iframe->render();
?>
