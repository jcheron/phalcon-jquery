<?php

namespace Ajax\semantic\html\collections;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\bootstrap\html\HtmlLink;
use Ajax\common\html\HtmlDoubleElement;

class HtmlMenu extends HtmlSemDoubleElement {

	public function __construct($identifier, $items=array()) {
		parent::__construct($identifier, "div");
		$this->setClass("ui menu");
		foreach ($items as $item){
			$this->addItem($item);
		}
	}

	/**
	 * Sets the menu type
	 * @param string $type one of text,item
	 * @return \Ajax\semantic\html\collections\HtmlMenu
	 */
	public function setType($type=""){
		return $this->addToPropertyCtrl("class", $type, array("","item","text"));
	}

	public function addItem($item){
		$itemO=$item;
		if(\is_string($item)){
				$itemO=new HtmlLink("item-".\sizeof($this->content),"",$item);
				$itemO->setClass("item");
		}
		$this->addContent($itemO);
	}

	/**
	 * Return the item at index
	 * @param int $index
	 * @return HtmlDoubleElement
	 */
	public function getItem($index) {
		if (is_int($index))
			return $this->content[$index];
			else {
				$elm=$this->getElementById($index, $this->content);
				return $elm;
			}
	}

	public function setActiveItem($index){
		$item=$this->getItem($index);
		if($item!==null){
			$item->addToProperty("class", "active");
		}
		return $this;
	}
}