<?php
	require_once ("Html.php");

	class Url {
		public ?string $date;
		public ?string $origin;
		public ?string $source;
		public ?string $reference;
		public ?string $descriptor;

		public function render() {
			$Url_properties = $this->Array_fromUrl();
			foreach ($Url_properties as $properties) { fprint("<td>$properties</td>"); }
		}

		public function __construct() {
			$this->date = "!set";
			$this->origin = "!set";
			$this->source = "!set";
			$this->reference = "!set";
			$this->descriptor = "!set";
		}
		public function inject(Url $Url) {}
		public function Array_fromUrl():array {
			return [ $this->date, $this->origin, $this->source, $this->reference, $this->descriptor];
		}
	}#endif Url

?>
