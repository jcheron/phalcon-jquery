<?php

namespace Ajax\semantic\html\content;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\Wide;

class HtmlGridCol extends HtmlSemDoubleElement{
	public function __construct($identifier,$width){
		parent::__construct($identifier,"div");
		$this->setClass("column");
		if(isset($width))
			$this->setWidth($width);
	}

	public function setWidth($width){
		if(\is_int($width)){
			$width=Wide::getConstants()["W".$width];
		}
		$this->addToPropertyCtrl("class", $width, Wide::getConstants());
		return $this->addToPropertyCtrl("class", "wide",array("wide"));
	}
}