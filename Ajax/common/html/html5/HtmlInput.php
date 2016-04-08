<?php

namespace Ajax\common\html\html5;

use Ajax\common\html\HtmlSingleElement;
use Ajax\service\JString;

class HtmlInput extends HtmlSingleElement {

	public function __construct($identifier,$type="text",$value="",$placeholder="") {
		parent::__construct($identifier, "input");
		$this->setProperty("name", $identifier);
		$this->setProperty("value", $value);
		if(JString::isNotNull($placeholder))
			$this->setProperty("placeholder", $placeholder);
		$this->setProperty("type", $type);
	}

	public function setValue($value) {
		$this->setProperty("value", $value);
	}

	public function setInputType($value) {
		$this->setProperty("type", $value);
	}
}