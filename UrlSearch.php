<?php
	require_once ("Html.php");
	require_once ("image.php");
	require_once ("ElementUtils.php");
	
	class UrlSearch {
		private ?Div $searchFrame;	
		
		public function __construct() {
			$this->searchFrame = new Div("UrlSearch");
			$this->config();
		}
		
		public function render():void { $this->searchFrame->iprint(); }
		
		private function createSearchBtns():Div {	
			$EUtil_arr = [EUtil::div, EUtil::search, EUtil::button];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[2]->iset("hsearch")->value("highlight");
			$E_arr[1]->iset("iframeSearch");
			$E_arr[0]->cset("UrlSearchBtns");
			$E_arr[0]->inject($E_arr[2]);
			$E_arr[0]->inject($E_arr[1]);
			return $E_arr[0];
		}

		private function createSearchTags():Div {
			$EUtil_arr = [EUtil::div, EUtil::p, EUtil::p,EUtil::p,EUtil::p,EUtil::p];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[0]->dset(2);
			$E_arr[0]->cset("UrlSearchTags");
			$E_arr[1]->iset("pointer")->innerHtml("github.com/");
			$E_arr[2]->iset("pointer")->innerHtml("Etz Hayim");
			$E_arr[3]->iset("pointer")->innerHtml("seeq.com/");
			$E_arr[4]->iset("pointer")->innerHtml("Node.js");
			$E_arr[5]->iset("pointer")->innerHtml("OpenJs");
			$E_arr[0]->inject($E_arr[1]);
			$E_arr[0]->inject($E_arr[2]);
			$E_arr[0]->inject($E_arr[3]);
			$E_arr[0]->inject($E_arr[4]);
			$E_arr[0]->inject($E_arr[5]);
			return $E_arr[0];
		}

		private function config ():void {
			$div = new Div("searchFrame");
			$div->inject($this->createSearchBtns());
			$div->inject($this->createSearchTags());
			$this->searchFrame->inject(image::create_img("globe2.webp"));

			$this->searchFrame->inject($div);
		}


	}#endif UrlSearch

?>
