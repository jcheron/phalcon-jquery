<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
require_once 'SimpleComponent.php';
class Progressbar extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->params=array("value"=>50);
		$this->uiName="progressbar";
	}
}