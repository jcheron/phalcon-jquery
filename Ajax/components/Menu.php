<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Menu
 * @author jc
 * @version 1.001
 */
class Menu extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="menu";
	}
}