<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\HtmlSemDoubleElement;

class HtmlFormField extends HtmlSemDoubleElement {
	public function __construct($identifier, $field,$label=NULL) {
		parent::__construct($identifier, "div","ui field");
		$this->content=array();
		if(isset($label))
			$this->setLabel($label);
		$this->setField($field);
	}

	public function setLabel($label){
		$labelO=$label;
		if(\is_string($label)){
			$labelO=new HtmlSemDoubleElement("","label");
			$labelO->setContent($label);
			$labelO->setProperty("for", \str_replace("field-", "",$this->identifier));
		}
		$this->content["label"]=$labelO;
	}

	public function setField($field){
		$this->content["field"]=$field;
	}

	public function getLabel(){
		if(\array_key_exists("label", $this->content))
			return $this->content["label"];
	}

	public function getField(){
		return $this->content["field"];
	}

	public function swapLabel(){
		$label=$this->getLabel();
		unset($this->content["label"]);
		$this->content["label"]=$label;
	}
}