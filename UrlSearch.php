<?php
	require_once ("Url.php");
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
			$EUtil_arr = [EUtil::div, EUtil::p, EUtil::p,EUtil::p,EUtil::p,EUtil::p,EUtil::p];
			$E_arr = ElementUtils::createElements($EUtil_arr);
			$E_arr[0]->dset(3);
			$E_arr[0]->cset("UrlSearchTags");
			for ($ind_K = 1; $ind_K <= 6; $ind_K++) 
				$E_arr[$ind_K]->iset("pointer")->innerHtml(input::randomColor());
			for ($ind_K = 1; $ind_K <= 6; $ind_K++) $E_arr[0]->inject($E_arr[$ind_K]);

			return $E_arr[0];
		}

		private function config ():void {
			$div = new Div("searchFrame");
			$div->inject($this->config_cHash());
			$div->inject($this->createSearchBtns());
			$div->inject($this->createSearchTags());

			$this->searchFrame->inject($div);
			$this->config_radio();
			#$this->config_cHash();
		}
		private function config_radio():void {
			$degree = [1,2,3];
			$descriptor = ["find post before: ", "end search for date: ", "end search for date: "];
			$radio = [EUtil::time, EUtil::time, EUtil::time];
			$div = Url::createSelection($radio,$descriptor,$degree);
			$div->cset("advanceSearch");
			$this->searchFrame->inject($div);
		}
		private function config_cHash():Div {
			$cDiv = ElementUtils::createColors(5);
			$cDiv->dset(2);
			$cDiv->cset("chash");
			return $cDiv;
		}


	}#endif UrlSearch

?>
