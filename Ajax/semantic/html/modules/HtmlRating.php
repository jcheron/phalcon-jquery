<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\JsUtils;

class HtmlRating extends HtmlSemDoubleElement {
	protected $_params=array();
	public function __construct($identifier, $value,$max=5,$icon="star") {
		parent::__construct($identifier, "div", "ui {$icon} rating");
		$this->setValue($value);
		$this->setMax($max);
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlDoubleElement::setValue()
	 */
	public function setValue($value){
		$this->setProperty("data-rating", $value);
	}

	public function setMax($max){
		$this->setProperty("data-max-rating", $max);
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\semantic\html\base\HtmlSemDoubleElement::run()
	 */
	public function run(JsUtils $js){
		parent::run($js);
		return $js->semantic()->rating("#".$this->identifier,$this->_params);
	}
}