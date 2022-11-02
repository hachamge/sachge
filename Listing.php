<?php
include_once("Html.php");

class Node {
	public ?Element $element;
	public $next;

	public function __construct() {
		$this->next = null;
		$this->element = null;
	}
}

/**
* Linear Linked List to manage an infinite List of html elements.
* it is setup to iteratively render inner html div elements and
* auto indent to maintain the format for the parent div tags.
*/
class Listing {
	private ?Node $head;

	/**
	 * initialize the head to point to a node.
	 * version 8.1.11 limitation. update in higher version update
	 *
	 * @return a head is set before any operation can take place
	 */
	public function __construct() {
		$this->head = null;
	}

	/**
	 * calls the insertSort method to insert the element into the list.
	 * the element is inserted based on the degree that was set on the input.
	 *
	 * @param Element $input the element to insert into the list
	 * @return the input element is added to the list based on the degree
	 */
	public function insert(Element $input):void {
		$this->insertSort($this->head, $input);	
	}

	/**
	 * recursively insert the element into the Listing in sorted order
	 * if the input has the same order as another element, the input is
	 * inserted in front of that element to indicate the order it occurred
	 *
	 * @param Node $head - the head of the Listing passed in by reference
	 * @param Element $input - the html element to add to the Listing the
	 * @return input is added to the Listing and the status is returned
	 */
	public function insertSort(&$head, Element $input):bool {
		if (!$head) {
			$head = $this->createNode($input);
			return true;
		}

		if ($input->degree > $head->element->degree) {
			return $this->insertSort($head->next, $input);
		}

		#prepend the input at the beginning 
		if ($input->degree <= $head->element->degree) {
			$tmp = $head->element;
			$head->element = $input;
			$input = $tmp;
			return $this->insertSort($head->next, $input);
		}

		return false;
	}
	
	/**
	* create a Node, inject the input and return a reference  for
	* the Node that was created. throw an exception if input is null
	*
	* @param Element $input - the html input to inject into the Node
	* @return a reference to the Node that was created with the input
	*/
	public function createNode(Element $input):Node {
		$tmp = new Node;
		$tmp->element = $input;
		return $tmp;
	}

	/**
	 * renders the elements inside the Listing to the document
	 * the $inStart variable is use to indent elements except for div
	 * the $indtart is used to indent elements for a div in format
	 *
	 * @param int $in - the indentation start for the elements
	 * @return the elements inside the Listing are rendered to document
	 */
	public function render(int $indStart = 1):void {
		if ($this->head == null) return;

		$tmp = $this->head;
		while($tmp) {
			if ($tmp->element instanceof Div) {
				# indent the parent div
				$tmp->element->iprint($indStart);
				$tmp = $tmp->next;
				continue;
			}
			if (!$tmp->element) return;
			# indent the children for the div
			$tmp->element->render($indStart);
			$tmp = $tmp->next;
		}
	}

}#endif

?>
