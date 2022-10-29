<?php
	require ("html.php");
	require ("url.php");
	
	$div = new Div();
	$div->set_class("url");

	$div->append(new iframe("http://1.com/"));
	$div->append(new iframe("http://2.com/"));
	$div->append(new iframe("http://3.com/"));

	$div3 = new Div();
	$div3->append(new iframe("http://4.com/"));

	$div->append($div3);

	$div->print();
?>
