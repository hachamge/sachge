<?php

/** 
 * this class is responsible for creating, and
 * formatting the url, and bookmarks element --divs
 */
class Url {
	/**
	 * the --url is the parent --div that contains the
	 * name of the url and the iframe --div, the iframe
	 * --div is the container that has the iframe with the
	 * loaded webpage view, the list of tags about the link
	 * and a description about the url link contents saved
	 */
	public Div $url;
	public Div $iframe;

	public function __construct() {
		$this->url = new Div();
		$this->iframe = new Div();

		$this->url->set_class("url");
		$this->iframe->set_class("url_frame");

		$this->url->append($this->iframe);
	}

	/**
	 * takes an array of string tags and add them
	 * to an inner div with a class attribute of
	 * --tags
	 *
	 * tags are short descriptors for a url to higlight
	 * the main features of a url link content
	 * from the list of --string tags create a p tag for
	 * each and append to the inner div
	 * @param array $tags - tags to append 
	 */
	private function set_tgs(array $tags):void {
		$tgs = new Div();
		$tgs->set_class("tgs");

		foreach ($tags as $tg) {
			$p = new Paragraph();
			$p->descriptor = $tg;
			$tgs->append($p);
		}
		$this->iframe->append($tgs);
	}

	/**
	 * insert the name of the --url frame
	 * the name is shown above the url frame when set
	 *
	 * @param string $url_name - the name of the url to set
	 * @return the url div has a h3 tag with the name of the url
	 */
	function set_url_name(string $name) {
		$url_name = new Heading(Size::h3);
		$url_name->descriptor = $name;

		$this->url->append($url_name);
	}

	function set_iframe(string $url) {
		$this->iframe->append(new iframe($url));

		// purpose for url bookmark
		$des_hd = new Heading(Size::h3);
		$des_hd->descriptor = "bluehost server for url boomarks";
		$this->iframe->append($des_hd);
	}

	function insert_url_frame(string $name, string $url, array $tgs = []):void {
		$this->set_url_name($name);
		$this->set_iframe($url);
		$this->set_tgs($tgs);

		$this->url->insert_tag();
	}
}

?>
