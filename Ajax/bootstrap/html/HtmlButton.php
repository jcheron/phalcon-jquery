<?php
namespace Ajax\bootstrap\html;

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
		$this->setProperty("class", "btn btn-default");
		$this->setProperty("role", "button");
	}

	public function setValue($value){
		$this->content=$value;
		return $this;
	}

	/**
	 * define the button style
	 * avaible values : "btn-default","btn-primary","btn-success","btn-info","btn-warning","btn-danger"
	 * @param string/int $cssStyle
	 * @return \Ajax\bootstrap\html\HtmlButton
	 * default : "btn-default"
	 */
	public function setStyle($cssStyle){
		if(is_int($cssStyle)){
			return $this->addToProperty("class", CssRef::buttonStyles()[$cssStyle]);
		}
		return $this->addToPropertyCtrl("class", $cssStyle, CssRef::buttonStyles());
	}

	/**
	 * define the button size
	 * available values : "btn-lg","","btn-sm","btn-xs"
	 * @param string/int $size
	 * @return \Ajax\bootstrap\html\HtmlButton
	 * default : ""
	 */
	public function setSize($size){
		if(is_int($size)){
			return $this->addToProperty("class", CssRef::sizes()[$size]);
		}
		return $this->addToPropertyCtrl("class", $size, CssRef::sizes());
	}

	/**
	 * Sets the "active" css class to the button
	 * @return \Ajax\bootstrap\html\HtmlButton
	 */
	public function setActive(){
		return $this->addToPropertyCtrl("class", "active",array("active"));
	}

	/**
	 * Disables the button
	 * @return \Ajax\bootstrap\html\HtmlButton
	 */
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
	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\BaseHtml::fromArray()
	 */
	public function fromArray($array) {
		$array=parent::fromArray($array);
		foreach ($array as $key=>$value){
			$this->setProperty($key, $value);
		}
		return $array;
	}


}