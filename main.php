<html>
<head>
	<link rel="stylesheet" href="Diagram.css">
</head>
<body>
<?php
	require_once ("Diagram.php");
	
	$href = [
		"https://vimcolorschemes.com/",
		"https://vim.fandom.com/wiki/Folding",
		"https://vimhelp.org/options.txt.html?#%27guifont%27"
	];

	$source = ["vim","gui","config"];
	$descriptor = [ "colors", "Folding", "guifont"];

	$Url_ref = new Url_Diagram();
	$Url_ref->heading(["date", "edit","chash", "source","origin", "hsearch","reference","descriptor"]);

	foreach ($href as $KEY=>$ref) {
		# config Url
		$Url = new Url_properties();
		$Url->reference->innerHtml("http://$KEY")->href($ref);
		$Url->descriptor->innerHtml($descriptor[$KEY]);
		$Url->source->innerHtml($source[$KEY]);

		$Url_ref->inject($Url);
	
	}
	# print
	$Url_ref->render();
?>
</body>
</html>
