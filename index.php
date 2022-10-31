<html>
<head>
	<link rel="stylesheet" href="Url.css">
</head>
<body>
<?php
	require("Url.php");
	require("Html.php");
	
	$Url = new Url(
		array("Color Palette","Themes","Background","HTML Color Schemes"),
		new Heading(Size::h4,"August 11, 2022"),
		new Heading(Size::h5,"5 minutes ago"),
		new iframe("https://htmlcolorcodes.com/color-chart/"),
		new Paragraph("Etz Hayim"),
		new Paragraph("Mais je dois vous expliquer comment est née toute cette idée erronée de dénoncer le plaisir et de louer la douleur et je vais vous donner un compte rendu complet du système, et exposer les enseignements réels du grand explorateur de la vérité, le maître-bâtisseur de l'humanité.")
	);

	$Url->render();
?>
</body>
</html>
