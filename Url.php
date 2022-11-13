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
		$div = new Div("UStatistics");
		$div->dset(6);
		$radio_arr = ElementUtils::createElements([EUtil::radio,EUtil::label,EUtil::radio,EUtil::label]);
		$radio_arr[0]->iset("highlight");
		$radio_arr[2]->iset("appropriate");
		$radio_arr[1]->for("highlight")->innerHtml("highlight");
		$radio_arr[3]->for("appropriate")->innerHtml("appropriate");
		#number iniatialization
		array_push($radio_arr,new input(inputType::number));
		#$radio_arr[4]->dset(5);
		$radio_arr[4]->min(1);
		$radio_arr[4]->max(10);
		$radio_arr[4]->iset("rating");
		array_push($radio_arr,new input(inputType::label));
		$radio_arr[5]->for("rating");
		$radio_arr[5]->innerHtml("rating 1-10");
		$this->setDegree($radio_arr,[1,2,3,4,5,6]);
		return $this->inject_insideDiv($div,$radio_arr);
	}
	private function inject_insideDiv(Div &$div, array $E_contents):Div {
		foreach ($E_contents as $E_info) {
			$div->inject($E_info);
		}	
		return $div;
	}
	private function config_href(href $href):void { $this->Url->inject($href); }

}#endif

?>
