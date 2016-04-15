<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormField;
use Ajax\common\html\html5\HtmlInput;

class HtmlFormInput extends HtmlFormField {

	public function __construct($identifier, $label=NULL,$type="text",$value=NULL,$placeholder=NULL) {
		if(!isset($placeholder))
			$placeholder=$label;
		parent::__construct("field-".$identifier, new HtmlInput($identifier,$type,$value,$placeholder), $label);
	}

	public function setPlaceholder($value){
		return $this->getField()->setPlaceholder($value);
	}

	public function setValue($value){
		return $this->getField()->setValue($value);
	}
}