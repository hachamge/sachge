<?php
	require("Html.php");
	
	$div = new Div();
	$p = new Paragraph("http://");

	$div->inject($p);
	$div->iprint();
?>
