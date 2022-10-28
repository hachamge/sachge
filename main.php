<?php
	require ("html.php");
	require ("url.php");
	
/*	$p = new Paragraph();
	$p->descriptor = "Highlight another url";
	#$p->insert_tag("search");

	$h1 = new Heading(Size::h2);
	$h1->descriptor = "Heading h1";
	#$h1->insert_tag();

	$url = new Div();

	$div = new Div();
	$div->append($h1);
	$div->append($p);
	$div->append($url);
	$div->set_class("url");
	$div->insert_tag();
*/

	$url = new Url();
	$tgs = ["delete","edit", "bug"];
	
	$url->insert_url_frame("Etz Hayim","http://sachge.com/", $tgs);
?>
