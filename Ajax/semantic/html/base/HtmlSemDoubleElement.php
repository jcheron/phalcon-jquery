<?php

namespace Ajax\semantic\html\base;

use Ajax\common\html\HtmlDoubleElement;

class HtmlSemDoubleElement extends HtmlDoubleElement {

	public function __construct($identifier, $tagName="p") {
		parent::__construct($identifier, $tagName);
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlSingleElement::setSize()
	 */
	public function setSize($size){
		return $this->addToPropertyCtrl("class", $size, Size::getConstants());
	}

	/**
	 * show it is currently unable to be interacted with
	 * @return \Ajax\semantic\html\elements\HtmlSemDoubleElement
	 */
	public function setDisabled(){
		return $this->addToProperty("class", "disabled");
	}

	/**
	 * @param string $color
	 * @return \Ajax\semantic\html\base\HtmlSemDoubleElement
	 */
	public function setColor($color){
		return $this->addToPropertyCtrl("class", $color,Color::getConstants());
	}
}