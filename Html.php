<?php
declare(strict_types = 1);

	require_once ("Listing.php");
	require_once ("input.php");
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
}#endif Size

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
	$indent = "\t";
	for ($i = 1; $i <= $ind; $i++) $indent .= "\t";
	echo ("$indent $input\n");
}

/**
 * --Element referes to every tag on a document
 * this class packages all the main features that
 * every element is given a default Degree of d1
 * --p, div, and --h tags etc. have such as id, and class attributes.
 */
abstract class Element {
	/**
	 * @var integer
	 * @range (1,6)
	 * @label ('the max sorting priority')
	 */
	public int $degree;
	public ?string $tag;
	protected ?string $id;
	protected ?string $class;
	protected ?string $innerHtml;

	public function __construct() {
		$this->degree = 1;
		$this->id = "!set";
		$this->tag = "!set";
		$this->class = "!set";
		$this->innerHtml = "!set";
	}

	public function iset(string $id) { $this->id = $id; }
	public function dset(int $deg) { $this->degree = $deg; }
	public function cset(string $css) {$this->class = $css; }
	public function innerHtml(string $innerHtml) {$this->innerHtml = $innerHtml; }

	/**
	 * add a color input into the html element.
	 * @param string $color - the color (hex) to set the color input
	 */
	public function injectColor(string $color = "#ff0000"):void {
		$append_str = "<input type=\"color\" value=\"$color\"> ";
		$this->tag = substr_replace($this->tag, $append_str, 3, 0);
	}
}#endif Element

// html --p tag element
class Paragraph extends Element {

	public function __construct(string $input = "") {
		parent::__construct();
		$this->tag = "<p></p>";
		$this->innerHtml($input);
	}

	public function iset(string $id):Paragraph {
		parent::iset($id);
		$this->tag = substr_replace($this->tag, " id=\"$id\"", 2, 0);
		return $this;
	}

	public function chash():void {
		$chash = input::randomColor();
		$CSS_rule = "background-color: $chash";
		$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 2, 0);
	}

	/**
	* set the innerHTML content for the Paragraph.
	* @param string $innerHtml - the innerHTML content to set
	*/
	public function innerHtml(string $innerHtml):void {
		parent::innerHtml($innerHtml);
		$this->tag = substr_replace($this->tag, $innerHtml, -4, 0);
	}

	/**
	 * 	create a p tag and render it to the document body
	 *	if no class attribute is set, a default of [nan] is given
	 *
	 *	@param string $class -- the class attribute to set 
	 *  @param int $ind -- the number of indent to set
	 *	@return the rendered tag to the document body
	 */
	function render(int $ind = 1):void {
		fprint ($this->tag, true, $ind);
	}	
}#endif Paragraph

// html --h tag element
class Heading extends Element {	
	public function __construct(Size $size) {
		parent::__construct();

		$this->tag = match($size) {
			Size::h1 => "<h1></h1>",
				Size::h2 => "<h2></h2>",
				Size::h3 => "<h3></h3>",
				Size::h4 => "<h4></h4>",
				Size::h5 => "<h5></h5>",
				Size::h6 => "<h6></h6>"
		};
	}
	
	/**
	* set the id for the html header element
	* @param string $id - the id to set the html element
	*/
	public function iset(string $id):void {
		parent::iset($id);
		$this->tag = substr_replace($this->tag, " id=\"$id\"", 3, 0);
	}

	/**
	* set the innerHTML content for the heading.
	* @param string $innerHtml - the innerHTML content to set
	*/
	public function innerHtml(string $innerHtml):void {
		parent::innerHtml($innerHtml);
		$this->tag = substr_replace($this->tag, $innerHtml, -5, 0);
	}

	/**
	 * create a h tag and render it to the document body
	 * @param int $ind -- the number of indent to set
	 * @return the rendered tag to the document body
	 */
	function render(int $ind = 1):void {
		fprint (sprintf ($this->tag, $this->innerHtml ), true, $ind);
	}
}#endif Heading

// html --div tag element
class Div extends Element {	
	/**
	 * stores the html tags for the div elements inside a Listing instance.
	 * items are inserted at the front for insertion unless the items have
	 * the degree set. if set the item is then insert based on that degree
	 */
	use Listing {
		render as public render;
		inject as public inject;
	}
	private string $start_tg;

	public function __construct(string $class_toset = "!set") {
		parent::__construct();
		$this->class = $class_toset;
		$this->start_tg = "<div>";
	}

	public function cset(string $cset):Div {
		parent::cset($cset);
		$this->tag = substr_replace($this->tag, " class=\"$cset\"", 4, 0);
		return $this;
	}
	# set the id for the parent div
	public function iset(string $id) {
		parent::iset($id);
		$this->start_tg = substr_replace($this->start_tg, " id=\"$id\"", -1, 0);
	}

	/**
	 * renders the elements inside the Listing $tgs to the document
	 * the children for the parent div are indented for formating
	 * @param int $indStart - the starting ind for the parent div 
	 * @return the div contents to render to the document in order
	 */
	public function iprint(int &$indStart = 0):void {
		$this->start($indStart);
		$this->render($indStart + 1);
		$this->endt($indStart);
	}

	private function start(int $indStart):void { 
		if ($this->class == "!set") fprint($this->start_tg, true, $indStart); 
		else fprint(substr_replace($this->start_tg," class=\"$this->class\"",4,0), true, $indStart);
	}
	/** 
	 * print the ending div tag flags can be enabled for customization
	 * such as whether to insert a newline after the div is printed
	 * @param int $ind the indent to set for the ending Html element
	 */
	private function endt(int $indStart):void {
		fprint("</div>", true, $indStart);
	}	
}#endif Div

class iframe extends Element {
	public string $href;

	public function __construct() {
		parent::__construct();
		$this->tag = "<iframe></iframe>";
	}

	public function href(string $href):iframe {
		$this->href = $href;
		$this->tag = substr_replace($this->tag, " src=\"$href\"", 7, 0);
		return $this;
	}
	
	/** 
	* enable the sanbox attribute for the iframe element. by default iframe
	* elements are not setup to have sandbox enabled. to disable the sandbox option
	* call the method disableSandbox to unset the sandbox configuration setting.
	*/
	public function sandbox() {
		$this->tag = substr_replace($this->tag, " sandbox", -10, 0);
	}

	/**
	* set the border frame for the iframe element. a default of 0 is given
	* if the input is not set to a certain border.
	* @param int $border - the border to set the iframe element
	*/
	public function frameBorder(int $border = 0):void {
		$this->tag = substr_replace($this->tag, " frameBorder=\"$border\"", -10, 0);
	}
	
	/**
	* set the scrolling configuration for the iframe element. if true
	* is given then the scrolling attribute is set to 0 to disable the 
	* the scrolling behavior. if false is set then the scolling attribue
	* is disabled.
	* @param bool $config - the boolean status to set the scrolling to
	*/
	public function scroll(bool $config):void {
		$this->tag = match($config) {
			true => substr_replace($this->tag, " scrolling=\"no\"", -10, 0),
			default => "unable to set the scroll config"
		};
	}

	public function render(int $ind = 1):void {
		fprint($this->tag, true, $ind);
	}
}#endif iframe

class href extends Element {
	public function __construct() {
		parent::__construct();
		$this->tag = "<a target=\"_blank\"></a>";
	}

	public function render($ind = 1):void { fprint($this->tag, true, $ind); }

	public function href(string $href):href {
		$this->tag = substr_replace($this->tag, " href=\"$href\"", 2, 0);
		return $this;
	}

	public function chash(?string $chash = null):void {
		if ($chash != null) {
			$CSS_rule = "background-color: $chash";
			$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 2, 0);
			return;
		}
		$chash = input::randomColor();
		$CSS_rule = "background-color: $chash";
		$this->tag = substr_replace($this->tag, " style=\"$CSS_rule\"", 2, 0);
	}

	public function iset(string $id):href {
		parent::iset($id);
		$this->tag = substr_replace($this->tag, " id=\"$id\" ", 3, 0);
		return $this;
	}

	public function innerHtml(string $innerHtml):href {
		parent::innerHtml($innerHtml);
		$this->tag = substr_replace($this->tag, $innerHtml, -4, 0);
		return $this;
	}


}#endif href

?>
