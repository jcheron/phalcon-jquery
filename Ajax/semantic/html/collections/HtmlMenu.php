<?php

namespace Ajax\semantic\html\collections;

use Ajax\bootstrap\html\HtmlLink;
use Ajax\common\html\HtmlCollection;
/**
 * Semantic Menu component
 * @see http://semantic-ui.com/collections/menu.html
 * @author jc
 * @version 1.001
 */
class HtmlMenu extends HtmlCollection {

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

	public function setActiveItem($index){
		$item=$this->getItem($index);
		if($item!==null){
			$item->addToProperty("class", "active");
		}
		return $this;
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\html5\HtmlCollection::addItem()
	 */
	public function addItem($item){
		$item=parent::addItem($item);
		$item->addToProperty("class", "item");
	}
	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\html5\HtmlCollection::createItem()
	 */
	protected function createItem($value) {
		$itemO=new HtmlLink("item-".\sizeof($this->content),"",$value);
		return $itemO->setClass("item");
	}

	public function setInverted(){
		return $this->addToProperty("class", "inverted");
	}
}