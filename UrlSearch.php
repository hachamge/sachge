<?php
	require_once ("Html.php");
	require_once ("image.php");
	require_once ("Url.php");

/** 
	an empty div throws an exemption that does not allow head to be access.fix(Later ..)

	$div = new Div();
	$div2 = new Div();
	$div3 = new Div();
	$div3->inject(new Paragraph("Etz Hayim"));
	$div2->inject(new Heading(Size::h3));
	$div->inject(new iframe());
	$div->inject(new iframe());
	$div2->inject($div3);
	$div->inject($div2);
	$div->iprint();
*/
/**
	$UrlSearch = new Div("UrlSearch");
	$SearchBtns = new Div("SearchBtns");
	$querySelector = new Div("QuerySelector");
	$searchHistory = new Div("searchHistory");
	$img = new image("http://config/images/bg");

	# setup searchBtns
	$hlBtn = new input(inputType::button);
	$searchBtn = new input(inputType::search);
	$SearchBtns->inject($hlBtn);
	$SearchBtns->inject($searchBtn);
	$querySelector->inject($SearchBtns);

	# setup search history
	$tgs = ["blog", "Etz Hayim", "git", "macOs"];
	#$searchHistory->injectStrToPtags($tgs);
	$querySelector->inject($searchHistory);

	# Url::Search
	$info = [$img, $querySelector];
	Url::setDegree($info, [1,2]);
	$UrlSearch->inject($img);
	$UrlSearch->inject($querySelector);
	#$UrlSearch->iprint();
**/
?>
