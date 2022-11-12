<?php 
	require_once ("Html.php");
	require_once ("input.php");

	enum EUtil {
		case p;
		case div;
		case button;
		case search; 
	}

	class ElementUtils {
		public function __construct() {}

		public static function createElements(array $EUtil_arr):array {
			$E_arr = [];
			foreach ($EUtil_arr as $ind_K=>$E_Util) {
				$E_arr[$ind_K] = match($E_Util){
					EUtil::div => new Div(),
					EUtil::p => new Paragraph(),
					EUtil::button => new input(inputType::button),
					EUtil::search => new input(inputType::search)
				};
			}

			return $E_arr;
		}

	}#endif ElementUtils
?>
