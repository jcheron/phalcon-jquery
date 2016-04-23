<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormInput;
use Ajax\semantic\html\base\constants\CheckboxType;
/**
 * Abstract class for Semantic Radio and Checkbox
 * @author jc
 * @version 1.001
 */
abstract class AbstractHtmlFormRadioCheckbox extends HtmlFormField {
	protected $_input;

	public function __construct($identifier, $name=NULL,$label=NULL,$value=NULL,$type=NULL) {
		$input=new HtmlFormInput($identifier,$label,"checkbox",$value);
		parent::__construct("rField-".$identifier, $input);
		if(isset($label)){
			$input->swapLabel();
			$label=$input->getLabel();
			$label->setClass="hidden";
			$label->setProperty("tabindex",0);
		}
		$this->_input=$input;
		$input->getField()->addToProperty("class","hidden");
	}

	public function setType($checkboxType){
		return $this->_input->addToPropertyCtrl("class", $checkboxType, CheckboxType::getConstants());
	}

	public function getInput() {
		return $this->_input;
	}

	public function setInput($_input) {
		$this->_input=$_input;
		return $this;
	}

	public function setReadonly(){
		$this->_input->getField()->setProperty("disabled","disabled");
		return $this->_input->addToProperty("class","read-only");
	}

}