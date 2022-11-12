<?php
	require_once ("Url.php");
	require_once ("Html.php");
	require_once ("image.php");
	require_once ("input.php");
	require_once ("ElementUtils.php");
	
	class UrlSearch {
		private ?Div $searchFrame;	
		
		public function __construct() {
			$this->searchFrame = new Div("UrlSearch");
			$this->searchFrame->inject($this->createSearchBtns());
		}
		
		public function render():void { $this->searchFrame->iprint(); }
		
		private function createSearchBtns():Div {	
			$EUtil_arr = [EUtil::div, EUtil::search, EUtil::button];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[0]->cset("UrlSearchBtns");
			$E_arr[0]->inject($E_arr[2]);
			$E_arr[0]->inject($E_arr[1]);
			return $E_arr[0];
		}

		private function createSearchTags():Div {

		}

		private function packageSearchBtn_tags (): Div {}


	}#endif UrlSearch

?>
