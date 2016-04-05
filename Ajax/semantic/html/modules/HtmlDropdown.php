<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\content\HtmlDropdownItem;
use Ajax\JsUtils;
use Ajax\semantic\html\elements\HtmlIcon;
use Ajax\common\html\html5\HtmlInput;
use Ajax\service\JArray;

class HtmlDropdown extends HtmlSemDoubleElement {
	protected $mClass="menu";
	protected $mTagName="div";
	protected $items=array ();
	protected $params=array("action"=>"select");
	protected $input;

	public function __construct($identifier, $value="", $items=array()) {
		parent::__construct($identifier, "div");
		$this->_template=include dirname(__FILE__).'/../templates/tplDropdown.php';
		$this->setProperty("class", "ui dropdown");
		$content=new HtmlSemDoubleElement("","div");
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
			$itemO=new HtmlDropdownItem("dd-item-".$this->identifier,$item,$value,$image);
		}
		$this->items[]=$itemO;
		return $itemO;
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

	public function asButton(){
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

	public function setValue($value){
		if(isset($this->input)){
			$this->input->setProperty("value", $value);
		}else{
			$this->setProperty("value", $value);
		}
		return $this;
	}

	/*
	 * (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->semantic()->dropdown("#".$this->identifier,$this->params);
		$this->addEventsOnRun($js);
		return $this->_bsComponent;
	}

	public function setAction($action){
		$this->params["action"]=$action;
	}
}