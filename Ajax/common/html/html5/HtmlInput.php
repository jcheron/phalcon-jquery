<?php

namespace Ajax\common\html\html5;

use Ajax\common\html\HtmlSingleElement;

class HtmlInput extends HtmlSingleElement {

	public function __construct($identifier,$type="text") {
		parent::__construct($identifier, "input");
		$this->setProperty("name", $identifier);
		$this->setProperty("value", "");
		$this->setProperty("type", $type);
	}

	public function setValue($value) {
		$this->setProperty("value", $value);
	}

	public function setInputType($value) {
		$this->setProperty("type", $value);
	}
}