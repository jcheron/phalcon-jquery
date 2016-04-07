<?php

namespace Ajax\semantic\html\elements;

use Ajax\common\html\html5\HtmlImg;

class HtmlImage extends HtmlImg {

	public function __construct($identifier, $src="", $alt="") {
		parent::__construct($identifier, $src, $alt);
		$this->setClass("ui image");
	}

	public function setCircular(){
		return $this->addToProperty("class", "circular");
	}
}