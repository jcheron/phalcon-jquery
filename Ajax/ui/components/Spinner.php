<?php
namespace Ajax\ui\Components;
use Ajax\JsUtils;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Spinner
 * @author jc
 * @version 1.001
 */
class Spinner extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="spinner";
	}
}