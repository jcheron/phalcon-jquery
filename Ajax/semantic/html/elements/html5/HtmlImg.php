<?php

namespace Ajax\semantic\html\elements\html5;

use Ajax\semantic\html\base\traits\BaseTrait;

class HtmlImg extends \Ajax\common\html\html5\HtmlImg {
	use BaseTrait;

	public function __construct($identifier, $src="", $alt="") {
		parent::__construct($identifier, $src, $alt);
		$this->_baseClass="ui image";
		$this->setClass($this->_baseClass);
	}
}