<?php

namespace Ajax\semantic\html;

use Ajax\common\html\HtmlDoubleElement;

/**
 * Semantic Button component
 * @see http://semantic-ui.com/elements/button.html
 * @author jc
 * @version 1.001
 */
class HtmlButton extends HtmlDoubleElement {

	/**
	 * Constructs an HTML Semantic button
	 * @param string $identifier HTML id
	 * @param string $value value of the Button
	 * @param string $cssStyle btn-default, btn-primary...
	 * @param string $onClick JS Code for click event
	 */
	public function __construct($identifier, $value="", $cssStyle=null, $onClick=null) {
		parent::__construct($identifier, "button");
		$this->setProperty("class", "ui button");
		$this->content=$value;
		if (isset($cssStyle)) {
			$this->setStyle($cssStyle);
		}
		if (isset($onClick)) {
			$this->onClick($onClick);
		}
	}

	/**
	 * Set the button value
	 * @param string $value
	 * @return \Ajax\semantic\html\HtmlButton
	 */
	public function setValue($value) {
		$this->content=$value;
		return $this;
	}

	/**
	 * define the button style
	 * @param string|int $cssStyle
	 * @return \Ajax\semantic\html\HtmlButton default : ""
	 */
	public function setStyle($cssStyle) {
		return $this->addToProperty("class",$cssStyle);
	}

	public function setFocusable(){
		$this->setProperty("tabindex", "0");
	}

	public function setAnimated($content,$animation=""){
		$this->setTagName("div");
		$this->addToProperty("class", "animated ".$animation);
		$visible=new HtmlDoubleElement("visible-".$this->identifier,"div");
		$visible->setClass("visible content");
		$visible->setContent($this->content);
		$hidden=new HtmlDoubleElement("hidden-".$this->identifier,"div");
		$hidden->setClass("hidden content");
		$hidden->setContent($content);
		$this->content=$visible.$hidden;
	}

	public function addIcon($icon,$before=true){
		$iconO=$icon;
		if(\is_string($icon)){
			$iconO=new HtmlIcon("icon-".$this->identifier, $icon);
		}
		$this->addContent($iconO,$before);
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\common\html\BaseHtml::fromArray()
	 */
	public function fromArray($array) {
		$array=parent::fromArray($array);
		foreach ( $array as $key => $value ) {
			$this->setProperty($key, $value);
		}
		return $array;
	}
}