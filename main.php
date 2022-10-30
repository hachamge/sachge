<?php
	require("Url.php");
	require("Html.php");
	require("image.php");
	
	$div = new Div("Url");
	$div->inject(new iframe("http://1.com"));
	$div->inject(new iframe("http://2.com"));
	
	#inner div for Url
	$div2 = new Div("Utgs");
	$div2->inject(new Paragraph("http://3.com"));
	$div2->inject(new Paragraph("http://4.com"));
	$div2->inject(new Paragraph("http://5.com"));
	
	#inner div for Utgs
	$div3 = new Div("div3");
	$div3->inject(new Paragraph("image"));
	$div4 =  new Div("div4");
	$div4->inject(new Paragraph("image 3"));
	$div3->inject($div4);
	$div2->inject($div3);
	
	$div->inject($div2);
	$div->iprint();
?>
