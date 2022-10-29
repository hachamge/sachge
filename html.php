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
	public string $descriptor;

	public function __construct() {
		$this->id = "Nan";
		$this->tag = "Nan";
		$this->class = "Nan";
		$this->descriptor = "Nan";
	}
}

// html --p tag element
class Paragraph extends Element {

	public function __construct() {
		parent::__construct();
		$this->tag = "<p class=\"%s\"> %s </p>";
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

	public function __construct() {
		parent::__construct();
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
		if ($div->is_empty()) return;
		
		$div->start($div->ind);
		foreach ($div->elements as $tg) {
			if ($tg instanceof Div) {
				$tg->ind += 1;
				$tg->set_class("$tg->ind");
				$this->rprint ($tg, $ind);
				continue;
			}
			$tg->insert_tag($div->ind + 1);
		}
		$div->endt($div->ind);
		return;

	}
    
	public function is_empty():bool {
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
	 * takes a url tag and add it to the element list
	 * meant to add info about a url for a quick summary
	 */
	public function append_tg(string $tg) {
		array_push($this->elements, $tg);
	}  

	/**
	 * print the elements of an inner div. for each
	 * inner div that is included increase the indent
	 * count by 1 for better formatting
	 */
	private function eprint():void {
		foreach($this->elements as $item) {
			if ($item instanceof Div) {
				//$item->start();
				//foreach($item->elements as $item3) {
				//$item3->insert_tag(2);
			}
			//$item->endt();
			$item->insert_tag(2);
			}
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

		/** 
		 * set the class for the --div
		 * 
		 * @param string $class - the class name for the div
		 *
		 * @return the class attribute is set from the input
		 */
		public function set_class(string $class) {
			$this->class = $class;
		}

		/**
		 * create a --div tag and render it to the document body.
		 * loop through the array of elements and parse them to the 
		 * --div
		 *
		 * @return the rendered tag to the document body
		 */
		public function insert_tag():void {
			echo ("<div class=\"$this->class\">\n");
			foreach ($this->elements as $element) {
				// print inner elements of div
				if ($element instanceof Div) {
					$element->start();
					// print the inner --divs content
					$element->eprint(2);	
					$element->endt();
					continue;
				}
				// print all other tags
				echo $element->insert_tag();
			}
			echo ("</div>\n");
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
