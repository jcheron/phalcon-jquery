<?php

namespace Ajax\semantic\html\base\traits;

use Ajax\semantic\html\base\constants\TextAlignment;

trait TextAlignmentTrait {

	/**
	 * @param string $value
	 * @return \Ajax\semantic\html\base\HtmlSemDoubleElement
	 */
	public function setTextAlignment($value=TextAlignment::LEFT){
		return $this->addToPropertyCtrl("class", $value,TextAlignment::getConstants());
	}
}