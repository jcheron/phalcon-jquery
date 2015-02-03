<?php
class HtmlInput extends \HtmlButton {
	protected $inputType;
	public function __construct($identifier) {
		$this->identifier=$identifier;
		$this->_template="<input type='%inputType%' id='%identifier%' %properties% value='%value%'/>";
		$this->setProperty("class", "form-control");
		$this->setProperty("role", "input");
		$this->inputType="text";
	}
}