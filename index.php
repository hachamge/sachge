<html>
<head>
	<link rel="stylesheet" href="CSS3/Url_config/Diagram.css">
	<link rel="stylesheet" href="Url_form.css">
</head>
<body id="Url_indexBody">
<?php
	require_once ("php_packages/Html.php");
	require_once ("Diagram.php");
	require_once ("Url_form.php");

	$Url_form = new Url_form();	
	$Url_form->render();

	$Url_ref = scandir("Url_Directories");
	unset($Url_ref[0]); // .
	unset($Url_ref[1]); // ..
	unset($Url_ref[2]); // .DS_Store
	$IND_KEY = 1;
	
	# instantiate Url Diagram
	$Url_Diagram = new Url_Diagram();
	$Url_Diagram->heading([
		"date <input type=\"time\">", 
		"edit <input type=\"button\" value=\"add Url\" id=\"edit\">",
		"chash", 
		"descriptor <input type=\"color\" value=\"#00ff2a\">",
		"origin <input type=\"search\" size=\"10\" id=\"searchDir\">", 
		"hsearch <input type=\"search\" size=\"10\" id=\"hsearch\">",
		"reference",
		"summary",
	]);

	foreach ($Url_ref as $KEY=>$Url_dir) {

		$Url_references = scandir("Url_Directories/$Url_dir");
		unset($Url_references[0]); // .
		unset($Url_references[1]); // ..
		unset($Url_references[2]); // .DS_Store

		foreach ($Url_references as $Url_DirContents) {
			# declare Url properties
			$Url = new Url_properties();

			# instantiate Url properties
			$href = file_get_contents("Url_Directories/$Url_dir/$Url_DirContents/href");
			$Url->dir->innerHtml($Url_DirContents);
			$Url->descriptor->innerHtml($Url_DirContents);
			$Url->reference->innerHtml("http://$IND_KEY")->href($href);
			$Url->origin->innerHtml($Url_dir);

			
			$Url_Diagram->inject($Url);
			$IND_KEY++;
		}	
	}
	$Url_Diagram->render();
?>

<script src="Url_search.js"></script>
<script src="hash_Url_reference.js"></script>
</body>
</html>
