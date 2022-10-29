<?php
include_once("Html.php");

/**
 * create, and render an image element to the document body
 * the image sets the loading property to lazy by default.
 */
class Image extends Element {
	private string $source;
	private string $alt;

	public function __construct(
			string $source = "!set", string $alt = "!set") {
		$this->alt = $alt;
		$this->source = $source;
		$this->tag = sprintf("<img src=\"%s\" alt=\"%s\" loading=\"lazy\">", $this->source, $this->alt);
	} 

	public function render():void {
		fprint($this->tag);
	}
}
?>
