<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormInput;
/**
 * Semantic Radio component
 * @see http://semantic-ui.com/collections/form.html#radio
 * @author jc
 * @version 1.001
 */
class HtmlFormRadio extends HtmlFormInput {

	public function __construct($identifier, $name=NULL,$label=NULL,$value=NULL) {
		parent::__construct($identifier, $label, "radio", $value=NULL);
		if(isset($name))
			$this->getField()->setProperty("name", $name);
		if(isset($label)){
			$this->swapLabel();
			$label=$this->getLabel();
			$label->setClass="hidden";
			$label->setProperty("tabindex",0);
		}
		$this->setClass("ui radio checkbox");
		$this->wrap("<div class='field'>","</div>");
	}
}