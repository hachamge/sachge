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
		$Uframe[0]->dset(2);
		$Uframe[0]->cset("Uframe");
		$Uframe[1]->cset("Details");

		foreach ($E_arr as $E_info) {
			if ($E_info instanceof href) continue;
			if (is_array($E_info)) {
				$Utgs = new Div("Utgs");
				$Utgs->dset(2);
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
		$Uframe[1]->inject($this->config_radio());
		return $Uframe[0];
	}
	private function config_radio():Div {	
		$selection = [EUtil::radio,EUtil::radio,EUtil::number,EUtil::range];
		$id = ["helpful","appropriate","rating",""];
		$div = self::createSelection($selection, $id, [1,2,3,4,5,6,7,8]);
		$div->cset("UStatistics")->dset(6);
		return $div;
	}
	public static  function createSelection(array $E_Utils, array $id_arr, array $degree):Div {
		$div = new Div();
		$radio_arr = [];
		$E_Utils = ElementUtils::createElements($E_Utils);
		foreach ($E_Utils as $ind_k=>$Element) {
			$descriptor = new input(inputType::label);
			$Element->iset($id_arr[$ind_k])->dset($degree[$ind_k]);
			$descriptor->for($id_arr[$ind_k])->innerHtml($id_arr[$ind_k])->dset($ind_k + 1);
			array_push($radio_arr, $descriptor, $Element);
		}
		return self::inject_insideDiv($div,$radio_arr);
	}
	private function config_href(href $href):void { $this->Url->inject($href); }

}#endif

?>
