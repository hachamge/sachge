<html>
<head>
	<link rel="stylesheet" href="UrlSearch.css"> 
</head>
<body>
<?php
	require_once ("Html.php");
	require_once ("Url_properties.php");
	
	$Url = new Url_properties();
	$Url->render();
?>
</body>
</html>
