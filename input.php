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

	public function render(int $ind = 1) {
		fprint($this->tag, true, $ind);
	}

	public function iset(string $id):void {
		parent::iset($id);

		$in1 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\">";
		$in2 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" $this->regx>";

		$this->tag = match($this->type) {
			"text","search","password" => $in2,
				default => $in1
		};
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
		$in = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" min=\"$min\">";
		$this->tag= $in;
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
		$in = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" max=\"$min\">";
		$this->tag= $in;
	}

	public function autocomplete():void {
		$in = " autocomplete=\"on\"";
		$endpos = strlen($this->tag) - 1;
		$this->tag = substr_replace($this->tag, $in, $endpos);
		$this->tag .= ">";
	}

}#endif
?>
