<?php
include_once("Html.php");

enum inputType:string {
	case url = "url";
	case color = "color";
	case date = "date";
	case file = "file";
	case image = "image";
	case code = "code";
	case radio = "radio";
	case reset = "reset";
	case text = "text";
	case time = "time";
	case email = "email";
	case month = "month";
	case label = "label";
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
	public string $regx;
	public string $name;
	public string $type;

	public function __construct(inputType $type) {
		parent::__construct();
	
		$this->type = $type->value;
		$cHash = self::randomColor();
		$this->regx = "pattern=\"[A-Za-z]{15}\"";

		# set the default iframe to configure
		$this->tag = match($type) {
			inputType::reset,inputType::url,inputType::file,inputType::time,
				inputType::date, inputType::radio, inputType::email, inputType::hidden,
				inputType::number, inputType::submit, inputType::button, inputType::checkbox, 
				inputType::month, inputType::range => "<input type=\"$this->type\">",

				inputType::code, inputType::search, 
				inputType::text => "<input type=\"$this->type\" $this->regx>",

				inputType::label => "<label></label>",
				inputType::color => "<input type=\"color\" value=\"$cHash\">",

				default => "<input type=\"text\" $this->regx>"
		};
	}

	public function chash():void {
		$chash = input::randomColor();
		$CSS_rule = "background-color: $chash";
		$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 6, 0);
	}
	
	public function setColor(string $color = "!set"):void {
		($color == "!set") ? ($color = $this->randomColor()) : ($color); 
		$this->tag = substr_replace($this->tag, " value=\"$color\"", -1, 0);
	}

	public static function randomColor():string {
		$cHash = "0123456789ABCDEF";
  		$color = "#";

  		for ($i = 0; $i < 6; $i++) $color .= $cHash[rand(0,15)];
  		return $color;	
	}

	public function for(string $fset):input {
		$this->tag = substr_replace($this->tag, " for=\"$fset\"", 6, 0);
		return $this;
	}

	public function innerHtml(string $buffer):input {
		$this->tag = substr_replace($this->tag, "$buffer", 6, 0);
		return $this;
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

	/**
	 * inject the min value into the input element. if the min is not set
	 * throw an exception if the correct input is not being reference before
	 * the min attribute can be set.
	 *
	 * @param int $min - the max value to set for the input element
	 * @return the min value is injected into the input element
	 */

	public function min(int $min):input {
		$this->min = $min;
		$this->append_str(" min=\"$min\"");
		return $this;
	}

	/**
	 * inject the max value into the input element. if the min is not set
	 * throw an exception so that the min value can be set first before max
	 * can be injected.
	 *
	 * @param int $max - the max value to set for the input element
	 * @return the max value is injected into the input element
	 */
	public function max(int $max):void {
		$this->max = $max;
		$this->append_str(" max=\"$max\"");
	}

	/**
	 * set the autocomplete attribute for the element
	 */
	public function autocomplete():void {
		$this->append_str(" autocomplete=\"on\"");
	}

	/**
	 * set the disabled attribute for the element
	 */
	public function disable():void {
		$this->append_str(" disabled");
	}

	/**
	 * set the required attribute for the element
	 */
	public function required():void {
		$this->append_str(" required");
	}

	/**
	 * set the auto focus attribute for the element
	 */
	public function autofocus():void {
		$this->append_str(" autofocus");
	}

	/**
	 * set the size attribute for the input element.
	 * @param string $size - the size to set for the input element
	 */
	public function size(string $size):void {
		$this->size = $size;
		$this->append_str("\" size=$size\"");
	}

	/**
	 * set the multiple attribute for the input element
	 */
	public function multiple():void {
		$this->append_str(" multiple");
	}
	
	/** 
	* set the max length for the text html element
	* @param int $maxlen - the max length to set the input for text
	*/
	public function maxlen(int $maxlen):void {
		$this->maxlen = $maxlen;
		$this->append_str($this->tag, " maxlength=\"$maxlen\"", -1, 0);
	}
	
	/**
	 * set the place holder for the input element
	 */
	public function placeHolder(string $pholder):void {
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

}#endif
?>
