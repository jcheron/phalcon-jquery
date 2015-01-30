<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Accordion
 * @author jc
 * @version 1.001
 */
class Accordion extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->params=array("active"=>1);
		$this->uiName="accordion";
	}
}