<?php
namespace Ajax\bootstrap\html;
use Ajax\bootstrap\html\base\HtmlSingleElement;
include_once 'base/HtmlSingleElement.php';
/**
 * Twitter Bootstrap simple Input component
 * @author jc
 * @version 1.001
 */
class HtmlInput extends HtmlSingleElement {
	public function __construct($identifier) {
		parent::__construct($identifier,"input");
		$this->setProperty("class", "form-control");
		$this->setProperty("role", "input");
		$this->setProperty("value", "");
		$this->setProperty("type", "text");
	}
	public function setValue($value){
		$this->setProperty("value", $value);
	}

	public function setInputType($value){
		$this->setProperty("type", $value);
	}
}