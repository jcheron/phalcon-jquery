<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\constants\CheckboxType;
/**
 * Semantic Checkbox component
 * @see http://semantic-ui.com/collections/form.html#checkbox
 * @author jc
 * @version 1.001
 */
class HtmlFormCheckbox extends AbstractHtmlFormRadioCheckbox {
	public function __construct($identifier, $label=NULL,$value=NULL,$type=NULL) {
		parent::__construct($identifier, NULL,$label,$value);
		$this->_input->setClass("ui checkbox");
		if(isset($type))
			$this->setType($type);
	}

	public function setType($checkboxType){
		return $this->_input->addToPropertyCtrl("class", $checkboxType, CheckboxType::getConstants());
	}
}