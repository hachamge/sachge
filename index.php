<html>
<head>
	<link rel="stylesheet" href="CSS3/Url/main.css">
</head>
<body>
<?php
	require_once ("Url.php");
	require_once ("ElementUtils.php");
	
	$href = ["github.blog/","nodejs.org/en/", "dev.java/","message.choomno.com/"];
	$descriptor = "Copyright OpenJS Foundation and Node.js contributors. All rights reserved. The OpenJS Foundation has registered trademarks and uses trademarks. For a list of trademarks of the OpenJS Foundation, please see our Trademark Policy and Trademark List. ";

foreach($href as $ind_k=>$E_info) {
	$EUtil_arr = ElementUtils::createElements([
		EUtil::p,
		EUtil::h4,
		EUtil::h5,
		EUtil::href,
		EUtil::iframe,
		ElementUtils::createElements([EUtil::href,EUtil::href,EUtil::href])
	]);
	Url::setDegree($EUtil_arr, [5,3,4,1,1]);

		#initialize
		$EUtil_arr[0]->innerHtml($descriptor);
		$EUtil_arr[1]->innerHtml("08/15/202$ind_k 9:50");
		$EUtil_arr[2]->innerHtml("$ind_k minutes ago");
		$EUtil_arr[3]->href($E_info)->iset("pointer");
		$EUtil_arr[3]->innerHtml($E_info);
		$EUtil_arr[4]->href("http://$E_info");
		$EUtil_arr[5][0]->href("http://1.com/")->iset("pointer")->innerHtml("http://1.com/");
		$EUtil_arr[5][1]->href("http://2.com/")->iset("pointer")->innerHtml("http://2.com/");
		$EUtil_arr[5][2]->href("http://3.com/")->iset("pointer")->innerHtml("http://3.com/");

		$Url = new Url($EUtil_arr);
	
		$Url->render();
 }

?>
</body>
</html>
