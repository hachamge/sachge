<?php
include_once("Html.php");

/**
 * create, and render an image element to the document body
 * the image sets the loading property to lazy by default.
 */
class image extends Element {
	private string $src;
	private string $descriptor;

	public function __construct() {
		parent::__construct();
		$this->src = "!set";
		$this->descriptor = "!set";
		$this->tag = "<img>";
	} 

	public function render():void { fprint($this->tag); }

	public function injectSrc(string $src):image {
		$this->src = $src;
		$this->tag = substr_replace($this->tag, " src=\"$this->src\"", 4, 0);
		return $this;
	}

	public static function create_img(string $src):image {
		$img = new image();
		$img->injectSrc($src);
		return $img;
	}
}
?>
