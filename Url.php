<?php

	require_once ("Html.php");
	require_once ("input.php");
	require_once ("ElementUtils.php");

# configure Url
class Url {
	private ?Div $Url;

	public function __construct(array $E_arr = []) {
		$this->Url = new Div("Url");
		$this->Url->inject($E_arr[3]);
		$this->Url->inject($this->config_Uframe($E_arr));

	}#endif __construct

	public function render():void { $this->Url->iprint(); }

	public static function setDegree(array &$E_arr, array $Deg_arr):void {
		foreach ($E_arr as $ind_k=>$E_info) {
			if (is_array($E_info)) continue;
			$E_info->dset($Deg_arr[$ind_k]);
		}
	}

	private function config_Uframe(array $E_arr):Div {
		$Uframe = ElementUtils::createElements([EUtil::div,EUtil::div,EUtil::h3]);
		$Uframe[2]->dset(2);
		$Uframe[0]->dset(2);
		$Uframe[0]->cset("Uframe");
		$Uframe[1]->cset("Details");
		$Uframe[2]->innerHtml("Description");

		foreach ($E_arr as $E_info) {
			if ($E_info instanceof href) continue;
			if (is_array($E_info)) {
				$Utgs = new Div("Utgs");
				foreach ($E_info as $pb) {
					$Utgs->inject($pb);
				}
				$Uframe[1]->inject($Utgs);
				continue;
			}
			$Uframe[1]->inject($E_info);
		}
		$Uframe[1]->inject($Uframe[2]);
		$Uframe[0]->inject($Uframe[1]);
		return $Uframe[0];
	}

	private function config_href(href $href):void { $this->Url->inject($href); }

}#endif

?>
