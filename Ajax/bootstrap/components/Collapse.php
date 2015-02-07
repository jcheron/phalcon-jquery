<?php
namespace Ajax\bootstrap\Components;
use Ajax\bootstrap\Components\SimpleBsComponent;
use Ajax\JsUtils;
/**
 * Composant Twitter Bootstrap Collapse
 * @author jc
 * @version 1.001
 */
class Collapse extends SimpleBsComponent {
	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="collapse";
	}

	public function attach($identifier){
		parent::attach($identifier);
		$this->js->attr($identifier,"data-toggle","collapse",true);
	}
}
