<html>
<head>
	<link rel="stylesheet" href="Diagram.css">
</head>
<body>
<?php
	require_once ("Html.php");
	require_once ("Diagram.php");
	
	$Url_ref = scandir("Url_info");
	unset($Url_ref[0]); // .
	unset($Url_ref[1]); // ..
	unset($Url_ref[2]); // .DS_Store
	$IND_KEY = 1;
	
	# instantiate Url Diagram
	$Url_Diagram = new Url_Diagram();
	$Url_Diagram->heading(["date", "edit","chash", "source","origin", "hsearch","reference","descriptor"]);

	foreach ($Url_ref as $KEY=>$Url_dir) {

		$Url_references = scandir("Url_info/$Url_dir");
		unset($Url_references[0]); // .
		unset($Url_references[1]); // ..
		unset($Url_references[2]); // .DS_Store

		foreach ($Url_references as $Url_DirContents) {
			# declare Url properties
			$Url = new Url_properties();

			# instantiate Url properties
			$href = file_get_contents("Url_info/$Url_dir/$Url_DirContents/href");
			$Url->dir->innerHtml($Url_DirContents);
			$Url->descriptor->innerHtml($Url_DirContents);
			$Url->reference->innerHtml("http://$IND_KEY")->href($href);
			$Url->origin->innerHtml($Url_dir);

			
			$Url_Diagram->inject($Url);
			$IND_KEY++;
		}
		
		#print_r($Url_references);
		#fprint($Url_references);	
	}
	$Url_Diagram->render();
?>
</body>
</html>
