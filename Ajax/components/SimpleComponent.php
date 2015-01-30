<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
class SimpleComponent extends BaseComponent {
	protected $attachTo;
	protected $uiName;

	public function __construct(JsUtils $js){
		parent::__construct($js);
	}

	public function __toString(){
		$allParams=$this->params;
		$this->jquery_code_for_compile[]="$( '".$this->attachTo."' ).{$this->uiName}(".$this->getParamsAsJSON($allParams).");";
		$result= implode("", $this->jquery_code_for_compile);
		$result=str_ireplace("\"%", "", $result);
		$result=str_ireplace("%\"", "", $result);
		$result=str_ireplace("\\n", "", $result);
		$result=str_ireplace("\\t", "", $result);
		return $result;
	}

	/**
	 * @param String $identifier identifiant CSS
	 */
	public function attach($identifier){
		$this->attachTo=$identifier;
	}

	public function addEvent($event,$jsCode){
		$this->setParam($event, "%function( event, ui ) {".$jsCode."}%");
	}
}