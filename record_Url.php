<?php
	// request info
	$href = $_POST['url'];
	$folder = $_POST['folder'];
	$group = $_POST['group'];
	$annotation = $_POST['annotation'];

	if (strlen($href) < 5) exit();
	$Url_Dir = "Url_Directories/$folder";
	$Url_group = "Url_Directories/$folder/$group";

	if (!file_exists($Url_Dir)) mkdir($Url_Dir);
	if (!file_exists($Url_group)) mkdir($Url_group);
	
	file_put_contents("$Url_group/annotation",$annotation);
	file_put_contents("$Url_group/href",$href);

?>
