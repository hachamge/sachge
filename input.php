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

	public function __construct(inputType $type, string $name) {
		parent::__construct();

		$this->name = $name;
		$this->type = $type->value;
		$this->regx = "pattern=\"[A-Za-z]{15}\"";

		$this->tag = match($type) {
			inputType::reset,inputType::url,inputType::file,inputType::time,
				inputType::date, inputType::radio, inputType::email, inputType::hidden,
				inputType::number, inputType::submit, inputType::button, inputType::checkbox, 
				inputType::color, inputType::month => "<input type=\"$this->type\" name=\"$name\">",

				inputType::code, inputType::search, 
				inputType::text => "<input type=\"$this->type\" name=\"$name\" $this->regx>",	

				default => "<input type=\"text\" $this->regx>"
		};
	}

	/**
	 * returns the ending position of the input element '>' such that
	 * append_str function can parse an attribute to the input element
	 * @return the ending position of the input element is returned. 
	 */
	public function endpos():int {
		return strlen($this->tag) - 1;
	}

	public function render(int $ind = 1) {
		fprint($this->tag, true, $ind);
	}

	/**
	 * sets the id for the input element.
	 * @param string $id - the id to set for the input element.
	 * @return the id is appended to the html input element tag
	 */
	public function iset(string $id):void {
		parent::iset($id);
		$this->append_str(" id=\"$id\"");
	}

	/**
	 * inject the min value into the input element. if the min is not set
	 * throw an exception if the correct input is not being reference before
	 * the min attribute can be set.
	 *
	 * @param int $min - the max value to set for the input element
	 * @return the min value is injected into the input element
	 */

	public function min(int $min):void {
		$this->min = $min;
		$this->append_str(" min=\"$min\"");
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
	 * set the attribute for the html input element. this appends the input
	 * into the element without overriding previously set attributes or repeat
	 *
	 * @param string $append_str - the attribute to append to the element input
	 * @return the $append_str attribute is appended to the element input
	 */
	public function append_str(string $append_str):void {
		$this->tag = substr_replace($this->tag, $append_str, $this->endpos());
		$this->tag .= ">";
	}

}#endif
?>
