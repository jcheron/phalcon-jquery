<?php
namespace Ajax\bootstrap\Components;
use Ajax\JsUtils;
use Ajax\common\SimpleComponent;
/**
 * Composant Twitter Bootstrap Modal
 * @author jc
 * @version 1.001
 */
class Modal extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="modal";
	}

	public function attach($identifier){
		parent::attach($identifier);
		$this->js->addClass($identifier,"modal",true);
		$this->js->attr($identifier,"role","dialog",true);
		$this->js->attr($identifier,"aria-labelledby","myModalLabel",true);
		$this->js->attr($identifier,"aria-hidden",true,true);
	}
}