<?php

namespace Ajax\semantic\html\collections\form;

/**
 * Semantic Radio component
 * @see http://semantic-ui.com/collections/form.html#radio
 * @author jc
 * @version 1.001
 */
class HtmlFormRadio extends AbstractHtmlFormRadioCheckbox {

	public function __construct($identifier, $name=NULL,$label=NULL,$value=NULL,$type=NULL) {
		parent::__construct($identifier, $name,$label,$value,$type);
		$this->_input->getField()->setProperty("type", "radio");
		$this->_input->setClass("ui radio checkbox");
		if(isset($name))
			$this->_input->getField()->setProperty("name", $name);
		if(isset($type))
			$this->setType($type);
	}
}