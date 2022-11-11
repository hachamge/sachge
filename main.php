<?php
	require_once("Url.php");
	require_once("Html.php");
	require_once("Listing.php");
	
	$div = new Div();
	$Lst = new Listing();
	$a_tag = new Link("http://1","Url.php");
	$a_tag->iset("pointer");
	//$a_tag->render();

	$div->inject($a_tag);
	$div->iprint();

	$Lst->insertSort($a_tag);
	$Lst->iprint();
?>
