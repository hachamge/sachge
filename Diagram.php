<?php

	require_once ("Url_properties.php");
	
	class Url_node {
		public ?Url_properties $Url;
		public ?Url_node $next;

		public function __construct(Url_properties $Url = null) {
			$this->Url = $Url; 
			$this->next = null;
		}
		# render the Url properties including: <tr></tr>
		public function render() {
			if (!$this->Url) return;

			fprint("<tr>", true, 1);
			$this->Url->render(2);
			fprint("</tr>", true, 1);
		}
	}#endif Url_node

	class Url_Diagram {
		private ?Url_node $head;

		public function __construct() { $this->head = null; }
		# wrapper function to the recursive print render_r
		public function render(){ 
			fprint("<table>", true, 0);
			$this->render_r($this->head); 
			fprint("</table>", true, 0);
		}
		
		# inject an Url properties
		public function inject($Url) {
			if (!$this->head) {
				$this->head = new Url_node();
				$this->head->Url = $Url;
				return;
			}
			# inject another Url properties
			$inject_Url = new Url_node();
			$inject_Url->Url = $Url;
			$inject_Url->next = $this->head;
			$this->head = $inject_Url;
		}

		# recursive function to print the diagram including: <table>,<th>
		private function render_r(?Url_node $head) {
			if (!$head) return;
			$head->render();
			return $this->render_r($head->next);
		}

	}#endif Url_Diagram
?>
