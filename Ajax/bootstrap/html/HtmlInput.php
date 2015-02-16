<?php
namespace Ajax\bootstrap\html;
use Ajax\bootstrap\html\base\HtmlSingleElement;
use Ajax\JsUtils;
include_once 'base/HtmlSingleElement.php';
/**
 * Twitter Bootstrap simple Input component
 * @author jc
 * @version 1.001
 */
class HtmlInput extends HtmlSingleElement {
	public function __construct($identifier) {
		parent::__construct($identifier,"input");
		$this->setProperty("name", $identifier);
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

	public function addLabel($label,$before=true){
		if ($before===true){
			$this->wrap("<label>".$label,"</label>");
		}else{
			$this->wrap("<label>","&nbsp;".$label."</label>");
		}
	}

	public function onClick($jsCode){
		return $this->addEvent("click", $jsCode);
	}


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->generic("#".$this->identifier);
		$this->addEventsOnRun();
		return $this->_bsComponent;
	}

	public function onChange($jsCode){
		return $this->addEvent("change", $jsCode);
	}

	public function onKeypress($jsCode){
		return $this->addEvent("keypress", $jsCode);
	}
}