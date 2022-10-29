<?php
	require ("html.php");
	require ("url.php");
	
	$div = new Div();

	$div->append(new iframe("http://1.com/"));
	$div->append(new iframe("http://2.com/"));
	$div->append(new iframe("http://3.com/"));

	$div3 = new Div();
	$div3->append(new iframe("http://4.com/"));
	$div3->append(new Paragraph());
	$div->append($div3);

	$div->print();
?>
