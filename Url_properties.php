<?php
	require_once ("Html.php");

	class Url_properties {
		# Url properties
		public ?string $date;
		public ?string $origin;
		public ?string $source;
		public ?string $reference;
		public ?string $descriptor;
		# render the Url properties including:<td></td>
		public function render(int $indStart = 1) {
			$Url_properties = $this->Array_fromUrl();
			foreach ($Url_properties as $properties) { fprint("<td>$properties</td>", true, $indStart); }
		}
		# set the Url properties to !set:string
		public function __construct() {
			$this->date = "!set";
			$this->origin = "!set";
			$this->source = "!set";
			$this->reference = "!set";
			$this->descriptor = "!set";
		}
		# convert the Url properties into an Array
		public function Array_fromUrl():array {
			return [ $this->date, $this->origin, $this->source, $this->reference, $this->descriptor];
		}
	}#endif Url

?>
