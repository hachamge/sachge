<?php
	require_once ("Html.php");

	class Url {
		public string $date;
		public string $origin;
		public string $folder;
		public string $reference;
		public string $descriptor;
		public function __construct() { $date = $origin = $folder = $reference = $descriptor = "!set"; }
	}

	class Url_node {
		public Url $Url_info;
		public $next_Url;

		public function __construct(Url $Url_info) {
			$this->Url_info = $Url_info;
			$next_Url = null;
		}

		public function render(int $indStart = 1) {
			fprint("<tr>", true, $indStart);
			fprint("<td>", true, $indStart);
				fprint($this->Url_info->date, true, $indStart+1);
				fprint($this->Url_info->origin, true, $indStart+1);
				fprint($this->Url_info->folder, true, $indStart+1);
				fprint($this->Url_info->reference, true, $indStart+1);
				fprint($this->Url_info->descriptor, true, $indStart+1);
			fprint("</td>", true, $indStart);
			fprint("</tr>", true, $indStart);
		}
	}#endif Url_node
?>
