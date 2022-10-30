<?php
	require("Url.php");
	require("Html.php");
	require("image.php");
	
	$div = new Div("Url");
	$div->inject(new iframe("http://1.com"));
	$div->inject(new iframe("http://2.com"));

	$div->iprint();
?>
