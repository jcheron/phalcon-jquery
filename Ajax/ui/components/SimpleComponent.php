<?php
namespace Ajax\ui\Components;

use Ajax\JsUtils;
/**
 * Base component for JQuery UI visuals components
 * @author jc
 * @version 1.001
 */
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
		$result = str_replace(array("\\n", "\\r","\\t"), '', $result);
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

	protected function setParamCtrl($key,$value,$typeCtrl){
		if(is_array($typeCtrl)){
			if(array_search($value, $typeCtrl)===false)
				throw new \Exception("La valeur passée a propriété `".$key. "` pour le composant `".$this->uiName."` ne fait pas partie des valeurs possibles : {".implode(",", $typeCtrl)."}");
		}else{
			if(!$typeCtrl($value)){
				throw new \Exception("La fonction ".$typeCtrl." a retourné faux pour l'affectation de la propriété ".$key." au composant ".$this->uiName);
			}
		}
		$this->setParam($key, $value);
	}
}