<?php

namespace Ajax\semantic\html\elements;

use Ajax\common\html\html5\HtmlImg;
use Ajax\semantic\html\base\traits\BaseTrait;

class HtmlImage extends HtmlImg {
	use BaseTrait;

	public function __construct($identifier, $src="", $alt="") {
		parent::__construct($identifier, $src, $alt);
		$this->_baseClass="ui image";
		$this->setClass($this->_baseClass);
	}

	public function setCircular(){
		return $this->addToProperty("class", "circular");
	}

	public function asAvatar($caption=NULL){
		if(isset($caption))
			$this->wrap("",$caption);
		return $this->addToProperty("class", "avatar");
	}
}