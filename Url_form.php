<?php 
	require_once ("php_packages/Html.php");
	require_once ("php_packages/ElementUtils.php");

class Url_form {
	public function __construct() {
		$this->html_tgs = [
			'url_descriptor' => html::descriptor,
			'url' => html::url,
			'group_descriptor' => html::descriptor,
			'group' => html::search,
			'folder_descriptor' => html::descriptor,
			'folder' => html::search,
			'annotation_descriptor' => html::descriptor,
			'annotation' => html::textarea,
			'submit' => html::submit
		];
		
		$this->html_tgs = ElementUtils::createElements($this->html_tgs);
		$this->html_tgs['submit']->value("hash Now!");
		$this->html_tgs['submit']->iset("record_Url");

		// set the label for each html input
		$this->html_tgs['url_descriptor']->innerHtml("Url reference");
		$this->html_tgs['folder_descriptor']->innerHtml("folder");
		$this->html_tgs['group_descriptor']->innerHtml("group");
		$this->html_tgs['annotation_descriptor']->innerHtml("paste a section from the site");
		
		$this->html_tgs['group']->descriptor("example: colors");
		$this->html_tgs['url']->descriptor("http://github.com/");
		$this->html_tgs['url']->required();
		$this->html_tgs['folder']->descriptor("example: neovim");

		// set the html attribute: name for every input
		foreach ($this->html_tgs as $KEY=>$html_tg) {
			if ($html_tg instanceof Descriptor) continue;
			$html_tg->name($KEY);
		}
	}

	public function render() {
		fprint("<form id=\"UrlForm\">", true, 0);
			fprint_r($this->html_tgs);
		fprint("</form>", true, 0);
	}
}#endif Url_form
?>
