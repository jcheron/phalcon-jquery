<?php
use Ajax\JsUtils;
include_once 'HtmlDoubleElement.php';
/**
 * Twitter Bootstrap Button component
 * @author jc
 * @version 1.001
 */
class HtmlButton extends HtmlDoubleElement {

	public function __construct($identifier) {
		parent::__construct($identifier,"button");
		$this->setProperty("class", "btn");
		$this->setProperty("role", "button");
	}

	public function setValue($value){
		$this->content=$value;
	}

	public function setStyle($cssStyle){
		return $this->addToPropertyCtrl("class", $cssStyle, CssRef::buttonStyles());
	}

	public function setSize($size){
		return $this->addToPropertyCtrl("class", $size, CssRef::buttonSizes());
	}

	public function setActive(){
		return $this->addToPropertyCtrl("class", "active",array("active"));
	}

	public function setDisabled(){
		return $this->addToPropertyCtrl("class", "disabled",array("disabled"));
	}

	public function __toString(){
		return $this->compile();
	}

	/* (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
	}

}