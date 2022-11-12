<?php
	require_once ("Url.php");
	require_once ("ElementUtils.php");
	
	$EUtil_arr = ElementUtils::createElements([
		EUtil::p,
		EUtil::h4,
		EUtil::h5,
		EUtil::href,
		EUtil::iframe,
		ElementUtils::createElements([EUtil::href,EUtil::href])
	]);

	Url::setDegree($EUtil_arr, [5,3,4,1,1]);
	
	$Url = new Url($EUtil_arr);
	#initialize
	$EUtil_arr[0]->innerHtml("python 3.0");
	$EUtil_arr[1]->innerHtml("08/15/2022 9:50");
	$EUtil_arr[2]->innerHtml("2 minutes ago");
	$EUtil_arr[3]->href("http://Etz Hayim.com/");
	$EUtil_arr[3]->innerHtml("http://1.com/");
	$EUtil_arr[4]->href("http://2.com/");
	$Url->render();
?>
