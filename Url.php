<?php

require_once("input.php");
require_once("Html.php");
/** 
 * this class is responsible for creating, and
 * formatting the entire url layout. Each url structure
 * has the url title and an inner div with the tags, date
 * relative Date, and descp for the url
 */
class Url {
	private Div $Url;
	private Div $Utgs;
	private Div $Uframe;
	private Div $Details;

	/**
	 * takes a list of (elements) html tags and insert them into the div
	 * --info the dependency is that the elements are entered in order as
	 * they will appear in the url frame so that the frame is rendered correctly
	 * @param Paragraph $title: the title for the url, also use to search for it
	 * @param Paragraph $tgs: the list of p tags highlighting the main features
	 * @param Heading $relativeDate: the relative date in realtion to date made
	 * @param Heading $date: the date when the url was created and processed
	 * @param iframe $iframe: the iframe containing the link to the site 
	 * @param Paragraph: short summary of the url and why it was useful
	 */
	public function __construct(
		array $tgs,
		Heading $date,
		Heading $rDate,
		iframe $iframe,
		Link $title,
		Paragraph $descp
	) {
		$this->Url = new Div("Url");
		$this->Uframe = new Div("Uframe");
		$this->Utgs = new Div("Utgs");
		$this->Details = new Div("Details");
		$dHeading = new Heading(Size::h3,"Description");
		
		#$descp->injectColor("#00ff2a");
		
		# create and inject the tags for the Url
		$this->injectUtags($tgs);
		
		# set the degree for the h elements, Uframe and Utgs
		$hElementsDegree = [2, 4, 5, 1, 2, 3, 6, 1, 2];
		$hElements = [$this->Utgs, $date, $rDate, $iframe, $this->Details, $dHeading, $descp, $title, $this->Uframe];
		$this->setDegree($hElements, $hElementsDegree);
		
		# create and inject the Uframe elements for the Url
		$iframe->scroll(true);
		$UframeElements = [$iframe, $this->Details];
		$this->injectElementsForUframe($UframeElements);
		
		# create, and inject  the radio elements for the Url
		#$radioElements = $this->createRadioElements();	
		$radioElements = $this->createRadioElements(["helpful","appropriate"], [7,9]);
		$numberElement = $this->createNumberElements(["rating"],[10]);
		$headingElements = [ $this->Utgs, $date, $rDate, $dHeading, $descp ];
		$this->injectElementsForDetail($headingElements);
		$this->injectElementsForDetail($radioElements);
		$this->injectElementsForDetail($numberElement);
		$cinput = new input(inputType::color); $cinput->dset(13); $cinput->setColor();
		$this->injectElementsForDetail([$cinput]);

		//$title->injectColor("#00FF2A");
		$title->iset("pointer");
		$this->Url->inject($title);
		$this->Url->inject($this->Uframe);
	  }

	/**
	*  insert the url into the document body.Once the url is rendered
	*  the according css attributes will become active and interactive
	*  with the javacript that is responsible for highlighting relavant
	*  search results for all url rendered that has a description tag 
	*/
	public function render():void {
		$this->Url->iprint();
	}

	private function injectUtags(array $tgs):void {
		foreach($tgs as $key=>$input) {
			$in = new Link($input,"http://$key.com/");
			//$in = new Paragraph($input);
			$in->iset("pointer");
			$this->Utgs->inject($in);	
		}
	}

	private function injectElementsForDetail(array $dElements):void {
		foreach ($dElements as $element) {
			$this->Details->inject($element);	
		}
	}

	public static function createRadioElements(array $radioElements_str, array $Degree = []):array {
		$radio_arr = [];
		foreach ($radioElements_str as $index=>$radio_str) {
			$deg = $Degree[$index];
			$radio = new input(inputType::radio);
			$radio->dset($deg);
			$radio->iset($radioElements_str[$index]);
			# create the label for the radio element
			$descriptor = new input(inputType::label);
			$descriptor->dset($deg+1);
			$descriptor->setLabelFor($radioElements_str[$index]);
			$descriptor->innerHtmlForLabel($radioElements_str[$index]);
			array_push($radio_arr, $radio, $descriptor);
		}
		return $radio_arr;
	}

	public static function createNumberElements(array $numberElements_str, array $Degree = []):array {
		$range_arr = [];
		foreach ($numberElements_str as $index=>$radio_str) {
			$number = new input(inputType::number);
			$number->min(1);
			$number->max(10);
			$number->dset(11);
			$number->iset("rating");
			# create the descriptor for the number element
			$descriptor = new input(inputType::label);
			$descriptor->dset(12);
			$descriptor->setLabelFor("rating");
			$descriptor->innerHtmlForLabel("rating 1 - 10");	
			array_push($range_arr, $number, $descriptor);
		}
		return $range_arr;
	}

	private function setDegree(array &$Elements, array $Degrees):void {
		foreach ($Elements as $index=>$element) {
			$element->dset($Degrees[$index]);			
		}
	}

	private function injectElementsForUframe(array $Elements):void {
		foreach ($Elements as $element) {
			$this->Uframe->inject($element);
		}
	}

}#endif

?>
