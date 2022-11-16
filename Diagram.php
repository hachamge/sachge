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
		private array $heading_tgs;

		public function __construct() { $this->head = null; }
		# wrapper function to the recursive print render_r
		public function render(){ 
			fprint("<table id=\"fixed_header\">", true, 0);
			$this->hprint();
			$this->render_r($this->head); 
			fprint("</table>", true, 0);
		}
		
		# create the heading for the Diagram:<th>
		public function heading(array $heading) {
			$htg = function(string $htg):string {return "<th>$htg</th>";};
			$this->heading_tgs = array_map($htg, $heading);	
		}

		# print the heading tags before the content
		private function hprint() {
			fprint("<tr>");
				foreach ($this->heading_tgs as $htg) { fprint($htg, true, 2); }
			fprint("</tr>");
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
