<html>
<head>
	<link rel="stylesheet" href="CSS3/Url/Url.css">
</head>
<body>
<?php
	require("Url.php");
	require("Html.php");
	require("input.php");
	
	$smp = ["github.blog/","nodejs.org/en/", "dev.java/","message.choomno.com/"];
	
	foreach($smp as $ind=>$input) {
	$Url = new Url(
		array("Color Palette","Themes","Background","$input"),
		new Heading(Size::h4,"08/03/202$ind 9:5$ind"),
		new Heading(Size::h5,"$ind minutes ago"),
		new iframe("https://$input"),
		new Paragraph($input),
		new Paragraph("Mais je dois vous expliquer comment est née toute cette idée erronée de dénoncer le plaisir et de louer la douleur et je vais vous donner un compte rendu complet du système, et exposer les enseignements réels du grand explorateur de la vérité, le maître-bâtisseur de l'humanité.")
	);
	
	$Url->render();
}

?>
</body>
</html>
