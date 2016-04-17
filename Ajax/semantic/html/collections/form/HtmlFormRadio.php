<?php

namespace Ajax\semantic\html\collections\form;

/**
 * Semantic Radio component
 * @see http://semantic-ui.com/collections/form.html#radio
 * @author jc
 * @version 1.001
 */
class HtmlFormRadio extends AbstractHtmlFormRadioCheckbox {

	public function __construct($identifier, $name=NULL,$label=NULL,$value=NULL) {
		parent::__construct($identifier, $name,$label,$value);
		$this->_input->getField()->setProperty("type", "radio");
		$this->_input->setClass("ui radio checkbox");
		if(isset($name))
			$this->_input->getField()->setProperty("name", $name);
	}
}