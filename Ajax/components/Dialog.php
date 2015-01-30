<?php
namespace Ajax\Components;
use Ajax\JsUtils;
require_once 'BaseComponent.php';
require_once 'Button.php';
/**
 * JQuery UI Dialog Component
 * @author jc
 * @version 1.001
 */
class Dialog extends BaseComponent{
	protected $attachTo;
	protected $buttons=array();

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->params=array("dialogClass"=>"no-close");
		$this->addCancelBtn("Annuler");
	}

	public function __toString(){
		$allParams=$this->params;
		$jsonButtons=array();
		foreach ($this->buttons as $button){
			$jsonButtons[]=$button->getParams();
		}
		$allParams["buttons"]=$jsonButtons;
		$this->jquery_code_for_compile[]="$( '".$this->attachTo."' ).dialog(".$this->getParamsAsJSON($allParams).");";
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
	public function addCancelBtn($caption="Annuler",$position=NULL){
		$this->insertBtn(Button::cancelButton($caption),$position);
	}
	public function addSubmitBtn(JsUtils $js,$url,$form,$responseElement,$caption="Valider",$position=NULL){
		$this->insertBtn(Button::submitButton($js, $url, $form, $responseElement,$caption),$position);
	}
	public function addButton($caption,$jsCode,$position=NULL){
		$this->insertBtn(new Button($caption, $jsCode),$position);
	}
	private function insertBtn($insert,$position=NULL)
	{
		if ($position!=NULL) {
			$this->buttons=array_splice($this->buttons, $position, 0, $insert);
		} else {
			$this->buttons[]=$insert;
		}
	}
}