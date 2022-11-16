<html>
<head>
	<link rel="stylesheet" href="Diagram.css">
</head>
<body>
<?php
	#require_once ("Html.php");
	require_once ("Diagram.php");
	#require_once ("Url_properties.php");
	
	$Url_properties = new Url_properties();
	$Url_properties->reference->innerHtml("Etz");
	$Url_properties->descriptor->innerHtml("reading");
	$Url_properties->source->innerHtml("config");

	$Url2 = new Url_properties();
	$Url2->reference->innerHtml("Etz Hayim");
	$Url2->descriptor->innerHtml("AirForce");
	#$Url_properties->reference = "Etz Hayim";
	#$Url_node = new Url_node($Url_properties);
	#$Url_node->render();
	$diagram = new Url_Diagram();
	$diagram->heading(["reference", "hsearch","date", "edit","source", "chash","descriptor","origin"]);
	$diagram->inject($Url_properties);
	#$diagram->inject($Url2);
	#$diagram->inject($Url2);
	#$diagram->inject($Url2);
	#$diagram->inject($Url2);
	#$diagram->inject($Url2);
	$diagram->render();
?>
</body>
</html>
