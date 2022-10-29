<?php

/** 
 * this class is responsible for creating, and
 * formatting the entire url layout. Each url structure
 * has the url title and an inner div with the tags, date
 * relative Date, and descriptor for the url
 */
class Url {
	private Div $urlFrame;

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
		iframe $iframe,
		Paragraph $title,
		Paragraph $descriptor,
		Heading $relativeDate,	
	) {
		$this->urlFrame = new Div("UrlFrame");
		$this->urlFrame->append($title);

		$url = new Div("Url");
		#1st
		$url->append($iframe);
		#2nd
		$utgs = new Div("Utgs");
		foreach ($tgs as $tg) $utgs->append(new Paragraph($tg));
		$url->append($utgs);
		#3rd
		$url->append(new Heading(Size::h3));
		#4th
		$url->append($date);
		#5th
		$url->append($relativeDate);
		#6th
		$url->append($descriptor);

		$this->urlFrame->append($url);
	}

	/**
	*  insert the url into the document body.Once the url is rendered
	*  the according css attributes will become active and interactive
	*  with the javacript that is responsible for highlighting relavant
	*  search results for all url rendered that has a description tag 
	*/
	public function render():void {
		$this->urlFrame->print();
	}
}

?>
