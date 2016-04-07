<?php

namespace Ajax\semantic\html\base\traits;
use Ajax\semantic\html\base\constants\Side;
trait AttachedTrait {
	/**
	 * @param string $side
	 * @return \Ajax\semantic\html\base\HtmlSemDoubleElement
	 */
	public function setAttachment($value=Side::BOTH){
			return $this->addToPropertyCtrl("class",$value." attached",Side::getConstantValues("attached"));
	}
}