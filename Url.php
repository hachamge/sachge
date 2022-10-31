<?php
/** 
 * this class is responsible for creating, and
 * formatting the entire url layout. Each url structure
 * has the url title and an inner div with the tags, date
 * relative Date, and descriptor for the url
 */
class Url {
	private Div $Url;

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
		$Utgs = new Div("Utgs");
		$Uframe = new Div("Uframe");
		$dHeading = new Heading(Size::h3,"Description!");

		# convert the tgs into p tags and insert
		foreach($tgs as $input) {
			$Utgs->inject(new Paragraph($input));	
		}
		
		# set the degree for the Url.div inputs
		$title->dset(1);
		$Uframe->dset(2);

		# set the degree for the Uframe.div inputs
		$Utgs->dset(2);
		$date->dset(4);
		$rDate->dset(5);
		$iframe->dset(1);
		$dHeading->dset(3);
		$descriptor->dset(6);

		# inject the items into the Url
		$Uframe->inject($Utgs);
		$Uframe->inject($date);
		$Uframe->inject($rDate);
		$Uframe->inject($iframe);
		$Uframe->inject($dHeading);
		$Uframe->inject($descriptor);
		
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
}

?>
