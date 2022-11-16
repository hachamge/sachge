<?php
	require_once ("Html.php");
	require_once ("input.php");
	# color hash
	$chash = [
		'time' => "#eee",
		'edit' => "#EEDC82",
		'hsearch' => "#FFFFFF",
		'origin' => "#FCF55F",
		'reference' => "#FFEA00",
		'descriptor' => "#FFFF8F",
		'dir' => input::randomColor(),
		'chash' => input::randomColor()
	];

	class Url_properties {
		# Url properties
		public ?input $time;
		public ?input $edit;
		public ?input $chash;
		public ?input $hsearch;
		public ?href $reference;
		public ?Paragraph $origin;
		public ?Paragraph $dir;
		public ?Paragraph $descriptor;
		# render the Url properties including:<td></td>
		public function render(int $indStart = 1) {
			global $chash;

			$Url_properties = $this->Array_fromUrl();
			foreach ($Url_properties as $KEY=>$properties) {
				$properties->chash($chash[$KEY]);
				fprint("<td>$properties->tag</td>", true, $indStart);
			}
		}
		# set the Url properties to !set:string
		public function __construct() {
			$this->dir = new Paragraph();
			$this->reference = new href();
			$this->origin = new Paragraph();
			$this->edit = new input(inputType::button);
			$this->time = new input(inputType::time);
			$this->chash = new input(inputType::color);
			$this->descriptor = new Paragraph();
			$this->hsearch = new input(inputType::checkbox);
		}
		# convert the Url properties into an Array
		public function Array_fromUrl():array {
			$radio = "<input type=\"radio\">";
			$properties = [
				'time' => $this->time,
				'edit' => $this->edit,
				'chash' => $this->chash,
				'dir' => $this->dir,
				'origin' => $this->origin,
				'hsearch' => $this->hsearch,
				'reference' => $this->reference,
				'descriptor' => $this->descriptor
			];
			$properties['edit']->value("edit");
			return $properties;
		}
	}#endif Url

?>
