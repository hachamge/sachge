<?php 
	require_once ("Html.php");
	require_once ("input.php");

	enum EUtil {
		case p;
		case h3;
		case h4;
		case h5;
		case div;
		case date;
		case time;
		case href;
		case image;
		case radio;
		case label;
		case range;
		case number;
		case button;
		case iframe;
		case search; 
	}

	class ElementUtils {
		public function __construct() {}

		public static function createElements(array $EUtil_arr):array {
			$E_arr = [];
			foreach ($EUtil_arr as $ind_K=>$E_Util) {	
				if (is_array($E_Util)) {
					$E_arr[$ind_K] = ElementUtils::createElements($E_Util);
					continue;
				}
				$E_arr[$ind_K] = match($E_Util){
					EUtil::div => new Div(),
					EUtil::href => new href(),
					EUtil::image => new image(),
					EUtil::p => new Paragraph(),
					EUtil::iframe => new iframe(),
					EUtil::h3 => new Heading(Size::h3),
					EUtil::h4 => new Heading(Size::h4),
					EUtil::h5 => new Heading(Size::h5),
					EUtil::date => new input(inputType::date),
					EUtil::time => new input(inputType::time),
					EUtil::range => new input(inputType::range),
					EUtil::label => new input(inputType::label),
					EUtil::radio => new input(inputType::radio),
					EUtil::number => new input(inputType::number),
					EUtil::button => new input(inputType::button),
					EUtil::search => new input(inputType::search),
					default => new href()
				};
				if ($E_arr[$ind_K] instanceof input)
					if ($E_arr[$ind_K]->type == "number") $E_arr[$ind_K]->min(1)->max(10);
			}
			return $E_arr;
		}

		public static function createColors(int $cnumber = 4):Div {
			$cDiv = new Div();
			for ($ind_K = 0; $ind_K < $cnumber; $ind_K++) $cDiv->inject(new input(inputType::color));
			return $cDiv;
		}

	}#endif ElementUtils
?>
