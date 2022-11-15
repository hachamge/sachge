<html>
<head>
	<link rel="stylesheet" href="UrlSearch.css"> 
</head>
<body>
<?php
	require_once ("Html.php");
	require_once ("Diagram.php");
	
	$Url = new Url();
	$Url->render();
?>
</body>
</html>
