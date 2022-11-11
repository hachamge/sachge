<?php
	require_once("Url.php");
	require_once("Html.php");

	$a_tag = new Link("http://1","Url.php");
	$a_tag->iset("pointer");
	$a_tag->render();
?>
