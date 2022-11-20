<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="Url_form.css">
</head>
<body>
<?php
	require_once ("Url_form.php");

	$Url_form = new Url_form();	
	$Url_form->render();
?>

<script src="hash_Url_reference.js"></script>
</body>
</html>
