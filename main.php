<html>
<head>
	<link rel="stylesheet" href="UrlSearch.css"> 
</head>
<body>
<?php
	#require_once ("Html.php");
	require_once ("Diagram.php");
	#require_once ("Url_properties.php");
	
	$Url_properties = new Url_properties();
	#$Url_properties->reference = readline("reference: ");
	#$Url_node = new Url_node($Url_properties);
	#$Url_node->render();
	$diagram = new Url_Diagram();
	$diagram->inject(new Url_properties());
	$diagram->render();
?>
</body>
</html>
