<?php

namespace Ajax\semantic\components;

use Ajax\JsUtils;
use Ajax\common\components\SimpleExtComponent;

class Dropdown extends SimpleExtComponent {

	public function __construct(JsUtils $js) {
		parent::__construct($js);
		$this->uiName="dropdown";
	}

	/**
	 * Sets a default action to occur
	 * @param string $action one of "select","auto","activate","combo","nothing","hide"
	 * @return \Ajax\semantic\components\Dropdown
	 */
	public function setAction($action){
		return $this->setParamCtrl("action", $action,array("select","auto","activate","combo","nothing","hide"));
	}
}