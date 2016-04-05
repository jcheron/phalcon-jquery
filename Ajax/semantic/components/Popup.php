<?php

namespace Ajax\semantic\components;

use Ajax\common\components\SimpleExtComponent;
use Ajax\JsUtils;

class Popup extends SimpleExtComponent {

	public function __construct(JsUtils $js) {
		parent::__construct($js);
		$this->uiName="popup";
	}

	/**
	 *
	 * @param string $value default : click
	 * @return $this
	 */
	public function setOn($value="click") {
		return $this->setParam("on", $value);
	}

	/**
	 * This event fires immediately when the show instance method is called.
	 * @param string $jsCode
	 * @return $this
	 */
	public function setOnShow($jsCode) {
		return $this->setParam("onShow", "%function(){".$jsCode."}%");
	}

	public function setExclusive($value){
		return $this->setParam("exclusive", $value);
	}
	//TODO other events implementation
}