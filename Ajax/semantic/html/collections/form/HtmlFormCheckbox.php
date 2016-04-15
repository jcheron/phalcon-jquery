<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormInput;
use Ajax\semantic\html\base\constants\CheckboxType;
/**
 * Semantic Checkbox component
 * @see http://semantic-ui.com/collections/form.html#checkbox
 * @author jc
 * @version 1.001
 */
class HtmlFormCheckbox extends HtmlFormInput {

	public function __construct($identifier, $label=NULL,$value=NULL,$type=NULL) {
		parent::__construct($identifier, $label, "checkbox", $value=NULL);
		if(isset($label)){
			$this->swapLabel();
			$label=$this->getLabel();
			$label->setClass="hidden";
			$label->setProperty("tabindex",0);
		}
		$this->setClass("ui checkbox");
		if(isset($type))
			$this->setType($type);
		$this->wrap("<div class='field'>","</div>");
	}

	public function setType($checkboxType){
		return $this->addToPropertyCtrl("class", $checkboxType, CheckboxType::getConstants());
	}
}