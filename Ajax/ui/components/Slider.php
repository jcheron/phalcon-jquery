<?php
namespace Ajax\ui\Components;
use Ajax\JsUtils;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Slider
 * @author jc
 * @version 1.001
 */
class Slider extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="slider";
		$this->setParam("value", 0);
	}
	public function onChange($jsCode){
		$this->addEvent("change", $jsCode);
	}

	public function onSlide($jsCode){
		$this->addEvent("slide", $jsCode);
	}
}