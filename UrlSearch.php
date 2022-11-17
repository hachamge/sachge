<?php
	require_once ("Html.php");
	require_once ("ElementUtils.php");
	
	class UrlSearch {
		private ?Div $searchFrame;	
		
		public function __construct() { $this->config(); }
		# render the config div to the html document
		public function render():void { $this->searchFrame->iprint(); }
		# create the search btns and return a div config for the btns
		private function createSearchBtns():Div {	
			$EUtil_arr = [EUtil::div, EUtil::search, EUtil::button];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[2]->iset("hsearch")->value("highlight");
			$E_arr[1]->iset("iframeSearch");
			$E_arr[0]->cset("UrlSearchBtns");
			$E_arr[0]->iset("UrlSearch_Btns");
			$E_arr[0]->inject($E_arr[2]);
			$E_arr[0]->inject($E_arr[1]);
			return $E_arr[0];
		}
		# call the method to create the search btn, and config
		private function config ():void {
			$this->searchFrame = $this->createSearchBtns();
		}
	}#endif UrlSearch
?>
