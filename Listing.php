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

class Listing {
	private ?Node $head;

	/**
	 * initialize the head to point to a node.
	 * version 8.1.11 limitation. update in higher version update
	 *
	 * @return a head is set before any operation can take place
	 */
	public function __construct() {
		$this->head = new node;
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

	public function insertSort(&$head, Element $input):bool {
		if ($head == null) {
			$head = new Node;
			$head->element = $input;
			return true;
		}

		if ($head->element == null) {
			$head->element = $input;
			return true;
		}

		if ($input->degree > $head->element->degree) {
			return $this->insertSort($head->next, $input);
		}

		if ($input->degree <= $head->element->degree) {
			$tmp = $head->element;
			$head->element = $input;
			$input = $tmp;
			return $this->insertSort($head->next, $input);
		}

		return false;
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
				$tmp->element->iprint($indStart);
				$tmp = $tmp->next;
				continue;
			}
			$tmp->element->render($indStart);
			$tmp = $tmp->next;
		}
	}
}

?>
