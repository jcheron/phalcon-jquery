<?php

namespace Ajax\bootstrap\components;

use Ajax\common\SimpleComponent;
use Ajax\common\JsCode;

class SimpleBsComponent extends SimpleComponent {
	protected $events=array ();
	protected $jsCodes=array ();

	public function addEvent($event, $jsCode) {
		$this->events [$event]=$jsCode;
	}

	public function getScript() {
		parent::getScript();
		foreach ( $this->jsCodes as $jsCode ) {
			$this->jquery_code_for_compile []=$jsCode->compile(array (
					"identifier" => $this->attachTo 
			));
		}
		return $this->compileJQueryCode();
	}

	public function addCode($jsCode) {
		$this->jsCodes []=new JsCode($jsCode);
	}
}