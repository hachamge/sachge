<?php
declare(strict_types = 1);

/**
 * the various h tags
 */
enum Size: string {
	case h1 = "h1";
	case h2 = "h2";
	case h3 = "h3";
}

/**
 * prints to the --$input 
 *
 * @param $input -- to be printed
 * @param bool $ind_set to enable indent
 * @param int $ind for number of indent to set
 * 
 * @return the formatted output
 */
function fprint($input, bool $ind_set = true, int $ind = 1):void {
	if ($ind_set && $ind >= 1) {
		$tb = "\t";
		for ($i = 1; $i < $ind; $i++) 	
			$tb .= "\t";
		echo ("$tb $input\n");
	}
	else echo ("$input\n");
}

/**
 * --descriptor is the text inside the element
 * this class packages all the main features that
 * --p, div, and --h tags have such as id, and class attributes.
 */
abstract class Element {
	public string $id;
	public string $tag;
	public string $class;
	public bool $attributes;
	public string $innerHTML;

	public function __construct() {
		$this->id = "!set";
		$this->tag = "!set";
		$this->class = "!set";
		$this->descriptor = "!set";
	}
}

// html --p tag element
class Paragraph extends Element {

	public function __construct(string $class = "!set") {
		parent::__construct();
		$this->tag = match ($class) {
			"!set" => "<p>%s</p>",
				default => "<p class=\"$class\">%s</p>"
		};
	} 

	/**
	 * 	create a p tag and render it to the document body
	 *	if no class attribute is set, a default of [nan] is given
	 *
	 *	@param string $class -- the class attribute to set 
	 *  @param int $ind -- the number of indent to set
	 *
	 *	@return the rendered tag to the document body
	 */
	function insert_tag(int $ind = 1):void {
		fprint (sprintf (
					$this->tag, 
					$this->class,
					$this->descriptor), true, $ind);
	}
}

// html --h tag element
class Heading extends Element {	
	public function __construct(Size $size) {
		parent::__construct();

		$this->tag = match($size) {
			Size::h1 => "<h1> %s </h1>",
				Size::h2 => "<h2> %s </h2>",
				Size::h3 => "<h3> %s </h3>"
		};
	}

	/**
	 * create a h tag and render it to the document body
	 *
	 * @param int $ind -- the number of indent to set
	 *
	 * @return the rendered tag to the document body
	 */
	function insert_tag(int $ind = 1):void {
		fprint (sprintf ($this->tag, $this->descriptor ), true, $ind);
	}
}

// html --div tag element
class Div extends Element {
	/**
	 * $ind is the indentation of the parent div
	 * this ($ind) indent will be used to indent child
	 * elements for inner div that are coupled inside the array
	 */
	public int $ind = 0;

	/**
	 * stores the html tags for the div elements. if a string was
	 * given inside the array of elements then it will be converted
	 * into a p tag by default and added to the array for printing 
	 */
	public array $elements = [];

	public function __construct(string $class_toset = "!set") {
		parent::__construct();
		$this->class = $class_toset;
	}

	/**
	 * the wrapper function for the recursive rprint function
	 * the descriptor from any div class can be used to set the
	 * name of the div, or the div content itself if no elements exist
	 */
	public function print() {	
		$this->rprint($this);
	}

	/**
	 * recursively print every element inside a div.
	 * for inner divs inside the array those will be indented
	 * base on the parents indent level for better formating
	 * so that all div elements are indented inside parent div

	 * @param Div $div - with html elements to print from
	 * @param int $ind - indentation level to start printing
	 *
	 * @return the printed div rendered to the document body
	 */
	private function rprint(Div $div, int &$ind = 0):void {
		if ($div->isEmpty()) return;

		$div->start($div->ind);
		foreach ($div->elements as $tg) {
			if ($tg instanceof Div) {
				$tg->ind += 1;
				$this->rprint ($tg, $ind);
				continue;
			}
			$tg->insert_tag($div->ind + 1);
		}
		$div->endt($div->ind);
		return;

	}

	public function isEmpty():bool {
		if (count($this->elements) === 0) return true;
		return false;
	}

	/**
	 * print the --start div tag
	 * @param int $ind -- the number of indent to set
	 */
	private function start(int $ind = 1):void {
		fprint("<div class=\"$this->class\">", true, $ind);
	}

	/** 
	 * print the ending div tag flags can be enabled for customization
	 * such as whether to insert a newline after the div is printed
	 */
	private function endt(int $ind = 1):void {
		fprint("</div>", true, $ind);
	}

	/**
	 ** takes an element and add it to the array of elements
	 *
	 * @param Element $element -- element to add to array
	 *
	 * @return the element is appended to the array
	 */
	public function append(Element $element):void {
		array_push ($this->elements, $element);	
	}
}

class iframe extends Element {
	public string $src;

	public function __construct(string $url) {
		$this->src = $url;
		$this->tag = "<iframe src=\"$this->src\"></iframe>";
	}

	public function insert_tag($ind = 1):void {
		fprint($this->tag, true, $ind);
	}
}

?>
