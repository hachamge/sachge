<?php
/** 
 * this class is responsible for creating, and
 * formatting the entire url layout. Each url structure
 * has the url title and an inner div with the tags, date
 * relative Date, and descriptor for the url
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
		Paragraph $title,
		Paragraph $descriptor
	) {
		$this->Url = new Div("Url");
		$Uframe = new Div("Uframe");
		$Details = new Div("Details");
		$dHeading = new Heading(Size::h3,"Description");
	
		$this->injectUtags($tgs);
		# set the degree for the Url.div inputs
		$title->dset(1);
		$Uframe->dset(2);
		$Details->dset(2);

		# the radio input
		$radio = new input(inputType::radio);
		$radio2 = new input(inputType::radio);
		$label1 = new input(inputType::label);
		$label2 = new input(inputType::label);

		# set the degree for the Uframe.div inputs
		$this->Utgs->dset(2);
		$date->dset(4);
		$rDate->dset(5);
		$iframe->dset(1);
		$dHeading->dset(3);
		$descriptor->dset(6);
		$radio->dset(7);
		$radio->iset("helpful");
		$label1->dset(8);
		$label1->setLabelFor("helpful");
		$label1->innerHtmlForLabel("helpful");

		$radio2->dset(9);
		$radio2->iset("appropriate");
		$label2->dset(10);
		$label2->setLabelFor("appropriate");
		$label2->innerHtmlForLabel("appropriate");

		$range = new input(inputType::number);
		$range->min(1);
		$range->max(10);
		$range->dset(11);
		$range->iset("rating");
		$label3 = new input(inputType::label);
		$label3->dset(12);
		$label3->setLabelFor("rating");
		$label3->innerHtmlForLabel("rating 1 - 10");

		# inject the items into the Url
		$Details->inject($this->Utgs);
		$Details->inject($date);
		$Details->inject($rDate);
		$iframe->scroll(true);
		$Uframe->inject($iframe);
		$Details->inject($dHeading);
		$descriptor->injectColor("#00ff2a");
		$descriptor->iset("descriptor");
		$Details->inject($descriptor);
		$Uframe->inject($Details);
		$Details->inject($radio);
		$Details->inject($label1);
		$Details->inject($radio2);
		$Details->inject($label2);
		$Details->inject($range);
		$Details->inject($label3);
		
		$title->injectColor("#00FF2A");
		$title->iset("pointer");
		$this->Url->inject($title);
		$this->Url->inject($Uframe);
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
		$this->Utgs = new Div("Utgs");
		
		foreach($tgs as $input) {
			$in = new Paragraph($input);
			$in->iset("pointer");
			$this->Utgs->inject($in);	
		}
	}

}#endif

?>
