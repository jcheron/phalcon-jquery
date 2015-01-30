<?php
namespace Ajax\Components;
use Phalcon\Text;
use Ajax\JsUtils;
require_once 'BaseComponent.php';
class Button extends BaseComponent{
	private function addFunction($jsCode){
		if(!Text::startsWith($jsCode, "function"))
			$jsCode="%function(){".$jsCode."}%";
		return $jsCode;
	}
	public function __construct($caption,$jsCode,$event="click"){
		parent::__construct(NULL);
		$this->params["text"]=$caption;
		$this->params[$event]=$this->addFunction($jsCode);
	}

	public function __toString(){
		return json_encode($this->params,JSON_UNESCAPED_SLASHES);
	}

	public static function cancelButton($caption="Annuler"){
		return new Button($caption,"$( this ).dialog( 'close' );");
	}
	public static function submitButton(JsUtils $js,$url,$form,$responseElement,$caption="Okay"){
		return new Button($caption,$js->postForm($url, $form, $responseElement).";$( this ).dialog( 'close' );");
	}
}