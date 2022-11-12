<?php
include_once("Html.php");

class image extends Element {
	private string $src;
	private string $descriptor;

	public function __construct() {
		parent::__construct();
		$this->src = "!set";
		$this->tag = "<img>";
		$this->descriptor = "!set";
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
