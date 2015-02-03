<?php
namespace Ajax\bootstrap\Components;
use Ajax\bootstrap\Components\SimpleBsComponent;
use Ajax\JsUtils;
/**
 * Composant Twitter Bootstrap Dropdown
 * @author jc
 * @version 1.001
 */
class Dropdown extends SimpleBsComponent {
	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="dropdown";
	}

	public function attach($identifier){
		parent::attach($identifier);
	}
}