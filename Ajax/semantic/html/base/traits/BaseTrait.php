<?php

namespace Ajax\semantic\html\base\traits;

use Ajax\semantic\html\base\constants\Size;
use Ajax\semantic\html\base\constants\Color;
trait BaseTrait {
	protected $_variations=[];
	protected $_states=[];
	protected $_baseClass;

	public function addVariation($variation){
		return $this->addToPropertyCtrl("class", $variation, $this->_variations);
	}

	public function addState($state){
		return $this->addToPropertyCtrl("class", $state, $this->_states);
	}

	public function setVariation($variation){
		$this->setPropertyCtrl("class", $variation, $this->_variations);
		return $this->addToProperty("class", $this->_baseClass);
	}

	public function setState($state){
		$this->setPropertyCtrl("class", $state, $this->_states);
		return $this->addToProperty("class", $this->_baseClass);
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

	public function setFluid(){
		$this->addToProperty("class", "fluid");
	}

	/**
	 * can be formatted to appear on dark backgrounds
	 */
	public function setInverted(){
		$this->addToProperty("class", "inverted");
	}
}