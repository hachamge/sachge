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
	public $min;
	public $max;
	public $name;
	public $size;
	public $value;
	public $regx;
	public $type;
	public $maxlen;

	public function __construct(inputType $type, string $name) {
		parent::__construct();
		
		$this->name = $name;
		$this->regx = "pattern=\"[A-Za-z]{15}\"";
		$this->type = $type->value;
		$this->tag = match($type) {
			inputType::reset => "<input type=\"reset\" >",	
			inputType::url => "<input type=\"url\" name=\"$name\">",
			inputType::file => "<input type=\"file\" name=\"$name\">",
			inputType::time => "<input type=\"time\" name=\"$name\">",	
			inputType::date => "<input type=\"date\" name=\"$name\">",		
			inputType::radio => "<input type=\"radio\" name=\"$name\">",	
			inputType::email => "<input type=\"email\" name=\"$name\">",	
			inputType::hidden => "<input type=\"hidden\" name=\"$name\">",	
			inputType::number => "<input type=\"number\" name=\"$name\">",	
			inputType::search => "<input type=\"search\" name=\"$name\">",	
			inputType::submit => "<input type=\"submit\" name=\"$name\">",	
			inputType::button => "<input type=\"button\" name=\"$name\">",	
			inputType::code => 	"<input type=\"password\" name=\"$name\">",
			inputType::checkbox => "<input type=\"checkbox\" name=\"$name\">",	
			inputType::month => "<input type=\"month\" name=\"$name\">",	
			inputType::color => "<input type=\"color\" name=\"$name\" value=\"#ff0000\">",
			inputType::text => "<input type=\"text\" name=\"$name\" $this->regx>",	
			
			default => "<input type=\"text\" >"
		};
	}
	
	public function render(int $ind = 1) {
		fprint($this->tag, true, $ind);
	}

	public function iset(string $id) {
		parent::iset($id);
		
		$in1 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\">";
		$in2 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" $this->regx>";
		$this->tag = match($this->type) {
			"text","search","password" => $in2,
			default => $in1
		};
	}
}
?>
