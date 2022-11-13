<html>
<head>
	<link rel="stylesheet" href="UrlSearch.css"> 
</head>
<body>
<?php
	require_once ("UrlSearch.php");
	
	$searchFrame = new UrlSearch();
	$searchFrame->render();
?>
</body>
</html>
