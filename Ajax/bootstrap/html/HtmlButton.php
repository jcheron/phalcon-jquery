<?php
use Ajax\JsUtils;
include_once 'BaseHtml.php';
/**
 * Twitter Bootstrap Button component
 * @author jc
 * @version 1.001
 */
class HtmlButton extends BaseHtml {
	protected $value;

	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->tagName="button";
		$this->_template="<%tagName% id='%identifier%' %properties%>%value%</%tagName%>";
		$this->setProperty("class", "btn");
		$this->setProperty("role", "button");
	}

	public function setValue($value){
		$this->value=$value;
	}

	public function setClass($classNames){
		$this->setProperty("class", $classNames);
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

	public function setRole($value){
		$this->setProperty("role", $value);
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