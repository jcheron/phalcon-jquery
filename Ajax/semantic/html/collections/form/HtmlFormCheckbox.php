<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormInput;

class HtmlFormCheckbox extends HtmlFormInput {

	public function __construct($identifier, $label=NULL,$value=NULL) {
		parent::__construct($identifier, $label, "checkbox", $value=NULL);
		if(isset($label)){
			$this->swapLabel();
			$label=$this->getLabel();
			$label->setClass="hidden";
			$label->setProperty("tabindex",0);
		}
		$this->setClass("ui checkbox");
		$this->wrap("<div class='field'>","</div>");
	}
}