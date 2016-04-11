<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\content\HtmlDropdownItem;
use Ajax\JsUtils;
use Ajax\semantic\html\elements\HtmlIcon;
use Ajax\common\html\html5\HtmlInput;
use Ajax\service\JArray;
use Ajax\semantic\html\base\constants\Direction;

class HtmlDropdown extends HtmlSemDoubleElement {
	protected $mClass="menu";
	protected $mTagName="div";
	protected $items=array ();
	protected $params=array("action"=>"auto","on"=>"hover");
	protected $input;

	public function __construct($identifier, $value="", $items=array()) {
		parent::__construct($identifier, "div");
		$this->_template=include dirname(__FILE__).'/../templates/tplDropdown.php';
		$this->setProperty("class", "ui dropdown");
		$content=new HtmlSemDoubleElement("text-".$this->identifier,"div");
		$content->setClass("text");
		$content->setContent($value);
		$content->wrap("",new HtmlIcon("", "dropdown"));
		$this->content=array($content);
		$this->tagName="div";
		$this->addItems($items);
	}

	public function addItem($item,$value=NULL,$image=NULL){
		$itemO=$item;
		if(\is_object($item)===false){
			$itemO=new HtmlDropdownItem("dd-item-".$this->identifier."-".\sizeof($this->items),$item,$value,$image);
		}elseif($itemO instanceof HtmlDropdownItem){
			$this->addToProperty("class", "vertical");
		}
		$this->items[]=$itemO;
		return $itemO;
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::fromDatabaseObject()
	 */
	public function fromDatabaseObject($object, $function) {
		$this->addItem($function($object));
	}

	public function addInput($name){
		if(!isset($name))
			$name="input-".$this->identifier;
		$this->setAction("activate");
		$this->input=new HtmlInput($name,"hidden");
	}

	public function addItems($items){
		if(JArray::isAssociative($items)){
			foreach ($items as $k=>$v){
				$this->addItem($v)->setData($k);
			}
		}else{
			foreach ($items as $item){
				$this->addItem($item);
			}
		}
	}

	/**
	 * @param boolean $dropdown
	 */
	public function asDropdown($dropdown){
		if($dropdown===false){
			$this->_template=include dirname(__FILE__).'/../templates/tplDropdownMenu.php';
			$dropdown="menu";
		}else{
			$dropdown="dropdown";
			$this->mClass="menu";
		}
		return $this->addToPropertyCtrl("class", $dropdown,array("menu","dropdown"));
	}

	public function setVertical(){
		return $this->addToPropertyCtrl("class", "vertical",array("vertical"));
	}

	public function setSimple(){
		return $this->addToPropertyCtrl("class", "simple",array("simple"));
	}

	public function asButton($floating=false){
		if($floating)
			$this->addToProperty("class", "floating");
		return $this->addToProperty("class", "button");
	}

	public function asSelect($name=NULL,$multiple=false,$selection=true){
		if(isset($name))
			$this->addInput($name);
		if($multiple)
			$this->addToProperty("class", "multiple");
		if ($selection)
			$this->addToPropertyCtrl("class", "selection",array("selection"));
		return $this;
	}

	public function asSearch($name=NULL,$multiple=false,$selection=false){
		$this->asSelect($name,$multiple,$selection);
		return $this->addToProperty("class", "search");
	}

	public function setSelect($name=NULL,$multiple=false){
		if(!isset($name))
			$name="select-".$this->identifier;
		$this->input=null;
		if($multiple){
			$this->setProperty("multiple", true);
			$this->addToProperty("class", "multiple");
		}
		$this->setAction("activate");
		$this->tagName="select";
		$this->setProperty("name", $name);
		$this->content=null;
		foreach ($this->items as $item){
			$item->asOption();
		}
		return $this;
	}

	public function asSubmenu($pointing=NULL){
		$this->setClass("ui dropdown link item");
		if(isset($pointing)){
			$this->setPointing($pointing);
		}
		return $this;
	}

	public function setPointing($value=Direction::NONE){
		return $this->addToPropertyCtrl("class", $value." pointing",Direction::getConstantValues("pointing"));
	}

	public function setValue($value){
		if(isset($this->input)){
			$this->input->setProperty("value", $value);
		}else{
			$this->setProperty("value", $value);
		}
		$textElement=$this->getElementById("text-".$this->identifier, $this->content);
		if(isset($textElement))
			$textElement->setContent($value);
		return $this;
	}

	/*
	 * (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
		if($this->propertyContains("class", "simple")===false){
			if(isset($this->_bsComponent)===false)
				$this->_bsComponent=$js->semantic()->dropdown("#".$this->identifier,$this->params);
			$this->addEventsOnRun($js);
			return $this->_bsComponent;
		}
	}

	public function setAction($action){
		$this->params["action"]=$action;
	}
}