<?php
include_once("Html.php");

enum inputType:string {
	case url = "url";
	case date = "date";
	case file = "file";
	case text = "text";
	case time = "time";
	case color = "color";
	case image = "image";
	case radio = "radio";
	case reset = "reset";
	case email = "email";
	case month = "month";
	case range = "range";
	case hidden = "hidden";
	case number = "number";
	case search = "search";
	case submit = "submit";
	case button = "button";
	case checkbox = "checkbox";
}

class input extends Element {
	public int $min;
	public int $max;
	public int $size;
	public int $value;
	public int $maxlen;
	public string $name;
	public string $type;

	public function __construct(inputType $type) {
		parent::__construct();
	
		$this->type = $type->value;
		# config the html based on the type that is set
		$this->tag = "<input type=\"$this->type\">";
	}
	
	public function regex(string $regex) {
		$this->tag = substr_replace($this->tag, " pattern=\"$regex\"", -1, 0);
	}

	public function regexDescriptor(string $descriptor) {
		$this->tag = substr_replace($this->tag, " title=\"$descriptor\"", -1, 0);	
	}

	public function chash(?string $chash = null):void {
		if ($chash != null) {
			$CSS_rule = "background-color: $chash";
			$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 6, 0);
			return;
		}
		$chash = input::randomColor();
		$CSS_rule = "background-color: $chash";
		$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 6, 0);
	}

	public static function randomColor():string {
		$cHash = "0123456789ABCDEF";
  		$color = "#";

  		for ($i = 0; $i < 6; $i++) $color .= $cHash[rand(0,15)];
  		return $color;	
	}

	public function value(string $input):input {
		$this->tag = substr_replace($this->tag, " value=\"$input\"", 6, 0);
		return $this;
	}

	/** 
	 * add the input element into the html document body.
	 * @param int $ind - the indentation for the element. this is used only 
	 * when the class elements are being tested on the terminal to verify format
	 */
	public function render(int $ind = 1):void {
		fprint($this->tag, true, $ind);
	}

	/**
	 * sets the id for the input element.
	 * @param string $id - the id to set for the input element.
	 * @return the id is appended to the html input element tag
	 */
	public function iset(string $id):input {
		parent::iset($id);
		$this->append_str(" id=\"$id\"");
		return $this;
	}

	// set the corresponding html attribute: min
	public function min(int $min):input {
		$this->min = $min;
		$this->append_str(" min=\"$min\"");
		return $this;
	}

	// set the corresponding html attribute: max
	public function max(int $max):void { $this->append_str(" max=\"$max\""); }

	// set the corresponding html attribute: disable 
	public function disable():void { $this->append_str(" disabled"); }

	// set the corresponding html attribute: autofocus
	public function autofocus():void { $this->append_str(" autofocus"); }
	
	// set the corresponding html attribute: required
	public function required():void { $this->append_str(" required"); }
	
	// set the corresponding html attribute: multiple
	public function multiple():void { $this->append_str(" multiple"); }

	// set the corresponding html attribute: size
	public function size(string $size):void { $this->append_str("\" size=$size\""); }
	
	// set the corresponding html attribute: autocomplete
	public function autocomplete():void { $this->append_str(" autocomplete=\"on\""); }
	
	// set the corresponding html attribute: maxlen
	public function maxlen(int $maxlen):void { $this->append_str($this->tag, " maxlength=\"$maxlen\"", -1, 0); }
	
	// set the corresponding html attribute: placeholder
	public function descriptor(string $pholder):void {
		$this->tag = substr_replace($this->tag, " placeholder=\"$pholder\"", -1, 0);
	}

	/**
	 * set the attribute for the html input element. this appends the input
	 * into the element without overriding previously set attributes or repeat
	 *
	 * @param string $append_str - the attribute to append to the element input
	 * @return the $append_str attribute is appended to the element input
	 */
	public function append_str(string $append_str):void {
		$this->tag = substr_replace($this->tag, $append_str, -1, 0);
	}

}#endif input

class Descriptor extends Element {
	public function __construct() {
		$this->tag = "<lable></label>";
	}
	
	public function for(string $fset):input {
		$this->tag = substr_replace($this->tag, " for=\"$fset\"", 6, 0);
		return $this;
	}

	public function innerHtml(string $buffer):input {
		$this->tag = substr_replace($this->tag, "$buffer", 6, 0);
		return $this;
	}
}#endif Descriptor
?>
