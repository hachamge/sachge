<?php
include_once("Html.php");

class image extends Element {
	private string $href;
	private string $descriptor;

	public function __construct() {
		parent::__construct();
		$this->href = "!set";
		$this->tag = "<img>";
		$this->descriptor = "!set";
	} 

	public function render(int $ind = 1):void { fprint($this->tag,true,$ind); }

	public function href(string $href):image {
		$this->href = $href;
		$this->tag = substr_replace($this->tag, " src=\"$this->href\"", 4, 0);
		return $this;
	}

	public static function create_img(string $href):image {
		$img = new image();
		$img->href($href);
		return $img;
	}
}
?>
