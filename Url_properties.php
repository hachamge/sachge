<?php
	require_once ("Html.php");
	require_once ("input.php");

	class Url_properties {
		# Url properties
		public ?input $time;
		public ?input $edit;
		public ?input $chash;
		public ?input $hsearch;
		public ?href $reference;
		public ?Paragraph $origin;
		public ?Paragraph $source;
		public ?Paragraph $descriptor;
		# render the Url properties including:<td></td>
		public function render(int $indStart = 1) {
			#$htg = function(Element $Element_tg):string { return "<td>$Element_tg</td>";}

			$Url_properties = $this->Array_fromUrl();
			foreach ($Url_properties as $properties) {
				$properties->chash();
				fprint("<td>$properties->tag</td>", true, $indStart);
			}
		}
		# set the Url properties to !set:string
		public function __construct() {
			$this->reference = new href();
			$this->edit = new input(inputType::button);
			$this->time = new input(inputType::time);
			$this->origin = new Paragraph();
			$this->source = new Paragraph();
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
				'source' => $this->source,
				'origin' => $this->origin,
				'hsearch' => $this->hsearch,
				'reference' => $this->reference,
				'descriptor' => $this->descriptor
			];
			$properties['edit']->value("edit");	
			$properties['source']->tag = substr_replace($properties['source']->tag, $radio,-4,0);
			return $properties;
		}
	}#endif Url

?>
