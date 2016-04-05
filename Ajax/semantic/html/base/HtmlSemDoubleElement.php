<?php

namespace Ajax\semantic\html\base;

use Ajax\common\html\HtmlDoubleElement;
use Ajax\JsUtils;
use Ajax\semantic\html\content\InternalPopup;
use Phalcon\Mvc\View;
use Ajax\semantic\html\elements\HtmlIcon;


class HtmlSemDoubleElement extends HtmlDoubleElement {
	protected $_popup=NULL;

	public function __construct($identifier, $tagName="p") {
		parent::__construct($identifier, $tagName);
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlSingleElement::setSize()
	 */
	public function setSize($size){
		return $this->addToPropertyCtrl("class", $size, Size::getConstants());
	}

	/**
	 * show it is currently unable to be interacted with
	 * @return \Ajax\semantic\html\elements\HtmlSemDoubleElement
	 */
	public function setDisabled(){
		return $this->addToProperty("class", "disabled");
	}

	/**
	 * @param string $color
	 * @return \Ajax\semantic\html\base\HtmlSemDoubleElement
	 */
	public function setColor($color){
		return $this->addToPropertyCtrl("class", $color,Color::getConstants());
	}

	public function setPopupAttributes($variation=NULL,$popupEvent=NULL){
		if(isset($this->_popup))
			$this->_popup->setAttributes($variation,$popupEvent);
	}

	public function addPopup($title="",$content="",$variation=NULL,$params=array()){
		$this->_popup=new InternalPopup($this,$title,$content,$variation,$params);
		return $this;
	}

	public function addPopupHtml($html="",$variation=NULL,$params=array()){
		$this->_popup=new InternalPopup($this);
		$this->_popup->setHtml($html);
		$this->_popup->setAttributes($variation,$params);
		return $this;
	}

	public function setFluid(){
		$this->addToProperty("class", "fluid");
	}

	/**
	 * can be formatted to appear on dark backgrounds
	 */
	public function setInverted(){
		$this->addToProperty("class", "inverted");
	}

	/**
	 * Adds an icon before or after
	 * @param string|HtmlIcon $icon
	 * @param boolean $before
	 * @param boolean $labeled
	 * @return \Ajax\semantic\html\elements\HtmlIcon
	 */
	public function addIcon($icon,$before=true,$labeled=false){
		$iconO=$icon;
		if(\is_string($icon)){
			$iconO=new HtmlIcon("icon-".$this->identifier, $icon);
		}
		if($labeled!==false){
			$this->addToProperty("class", "labeled icon");
			$this->tagName="div";
		}
		$this->addContent($iconO,$before);
		return $iconO;
	}

	/**
	 * show a loading indicator
	 * @return \Ajax\semantic\html\base\HtmlSemDoubleElement
	 */
	public function asLoader(){
		return $this->addToProperty("class", "loading");
	}

	public function compile(JsUtils $js=NULL, View $view=NULL){
		if(isset($this->_popup))
			$this->_popup->compile();
		return parent::compile($js,$view);
	}
	public function run(JsUtils $js){
		parent::run($js);
		if(isset($this->_popup)){
			$this->_popup->run($js);
			//$this->addEventsOnRun($js);
			//return $this->_bsComponent;
		}
	}
}