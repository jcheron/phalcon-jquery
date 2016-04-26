<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\collections\form\HtmlFormInput;
use Ajax\semantic\html\base\constants\CheckboxType;
/**
 * Abstract class for Semantic Radio and Checkbox
 * @author jc
 * @version 1.001
 */
abstract class AbstractHtmlFormRadioCheckbox extends HtmlFormField {
	protected $_input;
	protected $_params=array();

	public function __construct($identifier, $name=NULL,$label=NULL,$value=NULL,$type=NULL) {
		$input=new HtmlFormInput($identifier,$label,"checkbox",$value);
		parent::__construct("ck-field-".$identifier, $input);
		if(isset($label)){
			$input->swapLabel();
			$label=$input->getLabel();
			$label->setClass="hidden";
			$label->setProperty("tabindex",0);
		}
		$this->_input=$input;
		$input->getField()->addToProperty("class","hidden");
	}

	public function setType($checkboxType){
		return $this->_input->addToPropertyCtrl("class", $checkboxType, CheckboxType::getConstants());
	}

	public function getInput() {
		return $this->_input;
	}

	public function setInput($_input) {
		$this->_input=$_input;
		return $this;
	}

	public function setReadonly(){
		$this->_input->getField()->setProperty("disabled","disabled");
		return $this->_input->addToProperty("class","read-only");
	}

	/**
	 * Attach $this to $selector and fire $action
	 * @param string $selector jquery selector of the associated element
	 * @param string $action action to execute : check, uncheck or NULL for toggle
	 * @return \Ajax\semantic\html\collections\form\AbstractHtmlFormRadioCheckbox
	 */
	public function attachEvent($selector,$action=NULL){
		if(isset($action)!==false || \is_numeric($action)===true){
			$js='$("#%identifier%").checkbox("attach events", "'.$selector.'", "'.$action.'");';
		}else{
			$js='$("#%identifier%").checkbox("attach events", "'.$selector.'");';
		}
		$js=\str_replace("%identifier%", $this->_input->getIdentifier(), $js);
		return $this->executeOnRun($js);
	}

	/**
	 * Attach $this to an array of $action=>$selector
	 * @param array $events associative array of events to attach ex : ["#bt-toggle","check"=>"#bt-check","uncheck"=>"#bt-uncheck"]
	 * @return \Ajax\semantic\html\collections\form\AbstractHtmlFormRadioCheckbox
	 */
	public function attachEvents($events=array()){
		if(\is_array($events)){
			foreach ($events as $action=>$selector){
				$this->attachEvent($selector,$action);
			}
		}
		return $this;
	}

}