<html>
<head>
	<link rel="stylesheet" href="CSS3/Url/Url.css">
</head>
<body>
<?php
	require_once("Url.php");
	require_once("Html.php");
	require_once("input.php");
	
	$smp = ["github.blog/","nodejs.org/en/", "dev.java/","message.choomno.com/"];
	$desc = [
		"We are pleased to announce the expansion of All In for Students! All In for Students introduces college students to open source and provides them with the education, technical training and career development to prepare them for a summer internship in tech.",
		"Copyright OpenJS Foundation and Node.js contributors. All rights reserved. The OpenJS Foundation has registered trademarks and uses trademarks. For a list of trademarks of the OpenJS Foundation, please see our Trademark Policy and Trademark List. ",
		"JARs signed with SHA-1 algorithms are now restricted by default and treated as if they were unsigned. This applies to the algorithms used to digest, sign, and optionally timestamp the JAR. It also applies to the signature and digest algorithms of the certificates in the certificate ",
		"Vim is a great text editor that allows you to work with text files in the terminal easily and comfortably. Although this tutorial shows various ways to comment on multiple lines in Vim editor, it barely scratched the surface of Vim’s capabilities,"
	];

	foreach($smp as $ind=>$input) {
	$Url = new Url(
		array("http://1.com/","http://2.com/","http://3.com/"),
		new Heading(Size::h4,"08/03/202$ind 9:5$ind"),
		new Heading(Size::h5,"$ind minutes ago"),
		new iframe("https://$input"),
		new Paragraph($input),
		new Paragraph($desc[$ind])
	);
	
	$Url->render();
}

?>
</body>
</html>
