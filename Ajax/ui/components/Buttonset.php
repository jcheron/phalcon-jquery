<?php
namespace Ajax\ui\Components;

use Ajax\JsUtils;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Menu
 * @author jc
 * @version 1.001
 */
class Buttonset extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="buttonset";
	}

	/**
	 * Disables the buttonSet if set to true.
	 * @param Boolean $value
	 * default : false
	 */
	public function setDisabled($value){
		$this->setParamCtrl("disabled", $value, "is_bool");
	}

	/**
	 * Which descendant elements to convert manage as buttons.
	 * default : "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
	 * @param String $value
	 */
	public function setItems($value){
		$this->setParam("items", $value);
	}
}