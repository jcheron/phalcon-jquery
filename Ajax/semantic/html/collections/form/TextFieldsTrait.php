<?php

namespace Ajax\semantic\html\collections\form;

trait TextFieldsTrait {
	public function setPlaceholder($value){
		return $this->getField()->setPlaceholder($value);
	}

	public function setValue($value){
		return $this->getField()->setValue($value);
	}
}