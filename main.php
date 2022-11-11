<?php
	require("Url.php");

	$radio_deg = [7,9];
	$radio_str = ["helpful", "appropriate"];

	$radio_arr = Url::createRadio($radio_str, $radio_deg);
	print_r($radio_arr);
?>
