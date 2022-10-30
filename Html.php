<?php
declare(strict_types = 1);

include_once("Listing.php");
/**
 * Degree: 
 * represents the priority level of an element.
 * this is useful for adding elements to div without 
 * having to declare and add items in a sorted order
 * 1 is the highest. this means that a element with degree 1 will
 * be placed before a element with degree 2in that order on the Listing
 */

enum Size: string {
	case h1 = "h1";
	case h2 = "h2";
	case h3 = "h3";
	case h4 = "h4";
	case h5 = "h5";
	case h6 = "h6";
}

/**
 * prints to the --$input 
 *
 * @param $input -- to be printed
 * @param bool $ind_set to enable indent
 * @param int $ind for number of indent to set
 * 
 * @return the $input is rendered to the document. There is
 *		   a line break after with a default indent of 1tb. 
 */
function fprint($input, bool $ind_set = true, int $ind = 1):void {
	if ($ind_set && $ind >= 1) {
		$tb = "\t";
		for ($i = 1; $i < $ind; $i++) $tb .= "\t";
		echo ("$tb $input\n");
	}
	else echo ("$input\n");
}

/**
 * --Element referes to every tag on a document
 * this class packages all the main features that
 * every element is given a default Degree of d1
 * --p, div, and --h tags etc. have such as id, and class attributes.
 */
abstract class Element {
	public string $id;
	public int $degree;
	public string $tag;
	public string $class;
	public string $innerHtml;

	public function __construct() {
		$this->degree = 1;
		$this->id = "!set";
		$this->tag = "!set";
		$this->class = "!set";
		$this->descriptor = "!set";
	}

	/**
	 * each inheried class implements this function to
	 * to render thier content to the html document body
	 */
	abstract public function render():void;
}

// html --p tag element
class Paragraph extends Element {

	public function __construct(string $input = "!set") {
		parent::__construct();
		$this->innerHtml = $input;
		$this->tag = "<p>$this->innerHtml</p>";
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
	function render(int $ind = 1):void {
		fprint (sprintf (
					$this->tag, 
					$this->class,
					$this->innerHtml), true, $ind);
	}
}

// html --h tag element
class Heading extends Element {	
	public function __construct(Size $size, string $input = "!set") {
		parent::__construct();

		$this->tag = match($size) {
			Size::h1 => "<h1> %s </h1>",
				Size::h2 => "<h2> %s </h2>",
				Size::h3 => "<h3> %s </h3>",
				Size::h4 => "<h4> %s </h4>",
				Size::h5 => "<h5> %s </h5>",
				Size::h6 => "<h6> %s </h6>"
		};
		$this->innerHtml = $input;
		if ($input != "!set") $this->tag = sprintf($this->tag, $this->innerHtml);
	}

	/**
	 * create a h tag and render it to the document body
	 *
	 * @param int $ind -- the number of indent to set
	 *
	 * @return the rendered tag to the document body
	 */
	function render(int $ind = 1):void {
		fprint (sprintf ($this->tag, $this->descriptor ), true, $ind);
	}
}

// html --div tag element
class Div extends Element {	
	/**
	 * stores the html tags for the div elements inside a Listing instance.
	 * items are inserted at the front for insertion unless the items have
	 * the degree set. if set the item is then insert based on that degree
	 */
	public Listing $tgs;

	public function __construct(string $class_toset = "!set") {
		parent::__construct();
		$this->tgs = new Listing();
		$this->class = $class_toset;
	}
	
	/** 
	* the element to insert into the Listing instance $tgs
	* the Listing instance inserts elements in order or degree
	* 
	* @param Element $input - the input to insert inside into $tgs
	* @return the input element is inserted inside the Listing $tgs
	*/
	public function inject(Element $input):void {
		$this->tgs->insert($input);
	}
	
	/**
	* renders the elements inside the Listing $tgs to the document
	* the children for the parent div are indented for formating
	* @param int $indStart - the starting ind for the parent div
	* 
	* @return the div contents to render to the document in order
	*/
	public function iprint(int $indStart = 0):void {
		$this->start($indStart);
		$this->tgs->render($indStart + 1);
		$this->endt($indStart);
	}

	public function render():void {}

	/**
	 * print the --start div tag
	 * @param int $ind -- the number of indent to set
	 */
	private function start(int $ind = 0):void {
		fprint("<div class=\"$this->class\">", true, $ind);
	}

	/** 
	 * print the ending div tag flags can be enabled for customization
	 * such as whether to insert a newline after the div is printed
	 * @param int $ind the indent to set for the ending Html element
	 */
	private function endt(int $ind = 0):void {
		fprint("</div>", true, $ind);
	}
}

class iframe extends Element {
	public string $src;

	public function __construct(string $url = "!set") {
		parent::__construct();

		$this->src = $url;
		$this->tag = "<iframe src=\"$this->src\" loading=\"lazy\" sandbox></iframe>";
	}

	public function render(int $ind = 1):void {
		fprint($this->tag, true, $ind);
	}
}

?>
