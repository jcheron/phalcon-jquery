<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\elements\HtmlInput;

class HtmlSearch extends HtmlSemDoubleElement {

	public function __construct($identifier, $placeholder="") {
		parent::__construct("search-" . $identifier, "div", "ui search", array ());
		$this->createField();
		$this->createResult();
	}

	private function createField() {
		$this->content["field"]=new HtmlInput($this->identifier);
		return $this->content["field"];
	}

	private function createResult() {
		$this->content["result"]=new HtmlSemDoubleElement("results-" . $this->identifier, "div", "results");
		return $this->content["result"];
	}
}