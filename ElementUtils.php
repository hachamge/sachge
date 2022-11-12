<?php 
	require_once ("Html.php");
	require_once ("input.php");

	enum EUtil {
		case p;
		case h3;
		case h4;
		case h5;
		case div;
		case href;
		case image;
		case radio;
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
					EUtil::radio => new input(inputType::radio),
					EUtil::button => new input(inputType::button),
					EUtil::search => new input(inputType::search),
					default => new href()
				};
			}
			return $E_arr;
		}

	}#endif ElementUtils
?>
