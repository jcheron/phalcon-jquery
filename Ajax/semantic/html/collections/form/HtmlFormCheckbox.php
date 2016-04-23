<?php

namespace Ajax\semantic\html\collections\form;

/**
 * Semantic Checkbox component
 * @see http://semantic-ui.com/collections/form.html#checkbox
 * @author jc
 * @version 1.001
 */
class HtmlFormCheckbox extends AbstractHtmlFormRadioCheckbox {
	public function __construct($identifier, $label=NULL,$value=NULL,$type=NULL) {
		parent::__construct($identifier, NULL,$label,$value,$type);
		$this->_input->setClass("ui checkbox");
		if(isset($type))
			$this->setType($type);
	}
}