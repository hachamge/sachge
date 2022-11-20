<?php 
	require_once ("Html.php");
	require_once ("input.php");

	enum html {
		case p;
		case h3;
		case h4;
		case h5;
		case div;
		case url;
		case date;
		case time;
		case href;
		case label;
		case image;
		case radio;
		case range;
		case number;
		case button;
		case iframe;
		case search;
		case submit;
		case textarea;
		case descriptor;
	}

	class ElementUtils {
		public function __construct() {}

		public static function createElements(array $html_arr):array {
			$E_arr = [];
			foreach ($html_arr as $ind_K=>$E_Util) {	
				if (is_array($E_Util)) {
					$E_arr[$ind_K] = ElementUtils::createElements($E_Util);
					continue;
				}
				$E_arr[$ind_K] = match($E_Util){
					html::div => new Div(),
					html::href => new href(),
					html::image => new image(),
					html::p => new Paragraph(),
					html::iframe => new iframe(),
					html::label => new Descriptor(),
					html::h3 => new Heading(Size::h3),
					html::h4 => new Heading(Size::h4),
					html::h5 => new Heading(Size::h5),
					html::textarea => new textarea(),
					html::descriptor => new Descriptor(),
					html::submit => new input(inputType::submit),
					html::url => new input(inputType::url),
					html::date => new input(inputType::date),
					html::time => new input(inputType::time),
					html::range => new input(inputType::range),
					html::radio => new input(inputType::radio),
					html::number => new input(inputType::number),
					html::button => new input(inputType::button),
					html::search => new input(inputType::search),
					default => new href()
				};
				if ($E_arr[$ind_K] instanceof input)
					if ($E_arr[$ind_K]->type == "number") $E_arr[$ind_K]->min(1)->max(10);
			}
			return $E_arr;
		}	
	}#endif ElementUtils
?>
