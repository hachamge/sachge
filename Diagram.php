<?php

	require_once ("Url_properties.php");
	
	class Url_node {
		public ?Url_properties $Url;
		public ?Url_node $next_Url;

		public function __construct(Url_properties $Url = null) {
			$this->Url = $Url; 
			$this->next_Url = null;
		}
		# render the Url properties including: <tr></tr>
		public function render() {
			if (!$this->Url) return;

			fprint("<tr>", true, 1);
			$this->Url->render(2);
			fprint("</tr>", true, 1);
		}
	}#endif Url_node
?>
