<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\service\JArray;

class HtmlForm extends HtmlSemCollection{


	public function __construct( $identifier, $elements=array()){
		parent::__construct( $identifier, "form", "ui form");
		$this->setProperty("name", $this->identifier);
		$this->addItems($elements);
	}


	protected function createItem($value){
		if(\is_array($value)){
			$itemO=new HtmlFormInput(JArray::getDefaultValue($value, "id",""),JArray::getDefaultValue($value, "label",null),JArray::getDefaultValue($value, "type", "text"),JArray::getDefaultValue($value, "value",""),JArray::getDefaultValue($value, "placeholder",JArray::getDefaultValue($value, "label",null)));
			return $itemO;
		}else
		return new HtmlFormInput($value);
	}

}