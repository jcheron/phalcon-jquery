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
		parent::__construct($identifier, NULL,$label,$value,$type);
		$this->_input->setClass("ui checkbox");
		if(isset($type))
			$this->setType($type);
	}

	public static function slider($identifier, $label=NULL,$value=NULL){
		return new HtmlFormCheckbox($identifier,$label,$value,CheckboxType::SLIDER);
	}

	public static function toggle($identifier, $label=NULL,$value=NULL){
		return new HtmlFormCheckbox($identifier,$label,$value,CheckboxType::TOGGLE);
	}
}