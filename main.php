<html>
<head>
	<link rel="stylesheet" href="UrlSearch.css"> 
</head>
<body>
<?php
	require_once ("Diagram.php");
	
	$Url = new Url();
	$Url->reference = "Etz Hayim";
	$node = new Url_node($Url);	
	$node->render();
?>
</body>
</html>
