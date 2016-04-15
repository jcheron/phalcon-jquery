<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\service\JArray;
trait FieldsTrait {
	protected function createItem($value){
		if(\is_array($value)){
			$itemO=new HtmlFormInput(JArray::getDefaultValue($value, "id",""),JArray::getDefaultValue($value, "label",null),JArray::getDefaultValue($value, "type", "text"),JArray::getDefaultValue($value, "value",""),JArray::getDefaultValue($value, "placeholder",JArray::getDefaultValue($value, "label",null)));
			return $itemO;
		}else
			return new HtmlFormInput($value);
	}
}