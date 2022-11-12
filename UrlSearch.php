<?php
	require_once ("Html.php");
	require_once ("image.php");
	require_once ("ElementUtils.php");
	
	class UrlSearch {
		private ?Div $searchFrame;	
		
		public function __construct() {
			$this->searchFrame = new Div("UrlSearch");
			$this->config_searchBtn_tags();
		}
		
		public function render():void { $this->searchFrame->iprint(); }
		
		private function createSearchBtns():Div {	
			$EUtil_arr = [EUtil::div, EUtil::search, EUtil::button];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[2]->iset("hl_btn");
			$E_arr[1]->iset("urlSearch_btn");
			$E_arr[0]->cset("UrlSearchBtns");
			$E_arr[0]->inject($E_arr[2]);
			$E_arr[0]->inject($E_arr[1]);
			return $E_arr[0];
		}

		private function createSearchTags():Div {
			$EUtil_arr = [EUtil::div, EUtil::p, EUtil::p];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[0]->dset(2);
			$E_arr[0]->cset("UrlSearchTags");
			$E_arr[1]->iset("pointer")->innerHtml("github.com/");
			$E_arr[2]->iset("pointer")->innerHtml("Etz Hayim");
			$E_arr[0]->inject($E_arr[1]);
			$E_arr[0]->inject($E_arr[2]);
			return $E_arr[0];
		}

		private function config_searchBtn_tags ():void {
			$this->searchFrame->inject($this->createSearchBtns());
			$this->searchFrame->inject($this->createSearchTags());
			$this->searchFrame->inject(image::create_img("../config/image/bg"));
		}


	}#endif UrlSearch

?>
