<?php

namespace Ajax\semantic\html\base;

use Ajax\common\html\HtmlDoubleElement;
use Ajax\JsUtils;
use Ajax\semantic\html\content\InternalPopup;
use Phalcon\Mvc\View;
use Ajax\semantic\html\base\traits\BaseTrait;
use Ajax\semantic\html\modules\HtmlDimmer;

/**
 * Base class for Semantic double elements
 * @author jc
 * @version 1.001
 */
class HtmlSemDoubleElement extends HtmlDoubleElement {
	use BaseTrait;
	protected $_popup=NULL;
	protected $_dimmer=NULL;

	public function __construct($identifier, $tagName="p", $baseClass="ui", $content=NULL) {
		parent::__construct($identifier, $tagName);
		$this->_baseClass=$baseClass;
		$this->setClass($baseClass);
		if (isset($content)) {
			$this->content=$content;
		}
	}

	public function setPopupAttributes($variation=NULL, $popupEvent=NULL) {
		if (isset($this->_popup))
			$this->_popup->setAttributes($variation, $popupEvent);
	}

	public function addPopup($title="", $content="", $variation=NULL, $params=array()) {
		$this->_popup=new InternalPopup($this, $title, $content, $variation, $params);
		return $this;
	}

	public function addPopupHtml($html="", $variation=NULL, $params=array()) {
		$this->_popup=new InternalPopup($this);
		$this->_popup->setHtml($html);
		$this->_popup->setAttributes($variation, $params);
		return $this;
	}

	public function addDimmer($content=NULL) {
		$dimmer=new HtmlDimmer("dimmer-" . $this->identifier, $content);
		$this->addContent($dimmer);
		return $dimmer;
	}

	public function jsShowDimmer($show=true) {
		$status="hide";
		if ($show === true)
			$status="show";
		return '$("#.' . $this->identifier . ').dimmer("' . $status . '");';
	}

	public function compile(JsUtils $js=NULL, View $view=NULL) {
		if (isset($this->_popup))
			$this->_popup->compile();
		return parent::compile($js, $view);
	}

	public function run(JsUtils $js) {
		$this->_bsComponent=$js->semantic()->generic("#" . $this->identifier);
		parent::run($js);
		$this->addEventsOnRun($js);
		if (isset($this->_popup)) {
			$this->_popup->run($js);
		}
		return $this->_bsComponent;
	}
	/*
	 * public function __call($name, $arguments){
	 * $type=\substr($name, 0,3);
	 * $name=\strtolower(\substr($name, 3));
	 * $names=\array_merge($this->_variations,$this->_states);
	 * $argument=@$arguments[0];
	 * if(\array_search($name, $names)!==FALSE){
	 * switch ($type){
	 * case "set":
	 * if($argument===false){
	 * $this->removePropertyValue("class", $name);
	 * }else {
	 * $this->setProperty("class", $this->_baseClass." ".$name);
	 * }
	 * break;
	 * case "add":
	 * $this->addToPropertyCtrl("class", $name,array($name));
	 * break;
	 * default:
	 * throw new \Exception("Méthode ".$type.$name." inexistante.");
	 * }
	 * }else{
	 * throw new \Exception("Propriété ".$name." inexistante.");
	 * }
	 * return $this;
	 * }
	 */
}