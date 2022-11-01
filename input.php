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
			inputType::reset,inputType::url,inputType::file,inputType::time,
			inputType::date, inputType::radio, inputType::email, inputType::hidden,
			inputType::number, inputType::submit, inputType::button, inputType::checkbox, 
			inputType::color, inputType::month => "<input type=\"$this->type\" name=\"$name\">",
			
			#regx in
			inputType::code, inputType::search, 
			inputType::text => "<input type=\"$this->type\" name=\"$name\" $this->regx>",	
			
			default => "<input type=\"text\" $this->regx>"
		};
	}
	
	public function render(int $ind = 1) {
		fprint($this->tag, true, $ind);
	}

	public function iset(string $id) {
		parent::iset($id);
		
		$in1 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\">";
		$in2 = "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" $this->regx>";
		
		#return format input
		$this->tag = match($this->type) {
			"text","search","password" => $in2,
			default => $in1
		};
	}
}
?>
