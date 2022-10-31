<?php
	require("Url.php");
	require("Html.php");
	require("image.php");
	
	$Url = new Url(
		array("iprint","dset","rDate"),
		new Heading(Size::h4,"August 11, 2022"),
		new Heading(Size::h5,"3days ago"),
		new iframe("http://1.com/"),
		new Paragraph("Etz Hayim"),
		new Paragraph("rain!")
	);

	$Url->render();
?>
