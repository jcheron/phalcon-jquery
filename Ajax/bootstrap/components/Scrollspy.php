<?php

namespace Ajax\bootstrap\components;

use Ajax\bootstrap\components\SimpleBsComponent;
use Ajax\JsUtils;

/**
 * Composant Twitter Bootstrap Scrollspy
 * @author jc
 * @version 1.001
 */
class Scrollspy extends SimpleBsComponent {

	public function __construct(JsUtils $js) {
		parent::__construct($js);
		$this->uiName="scrollspy";
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\common\SimpleComponent::attach()
	 */
	public function attach($identifier) {
		parent::attach($identifier);
	}

	public function setTarget($target) {
		$this->setParam("target", $target);
	}

	public function onActivate($jsCode) {
		$this->addEvent("activate.bs.scrollspy", $jsCode);
	}
}