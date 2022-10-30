<?php
	require("Url.php");
	require("Html.php");
	require("image.php");
	
	$div = new Div("Url");
	$div->inject(new iframe("http://1.com"));
	$div->inject(new iframe("http://2.com"));
	
	#inner div
	$div2 = new Div("Utgs");
	$div2->inject(new Paragraph("http://3.com"));
	$div2->inject(new Paragraph("http://4.com"));
	$div2->inject(new Paragraph("http://5.com"));
	
	$div->inject($div2);
	$div->iprint();
?>
