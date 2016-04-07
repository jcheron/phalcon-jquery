<?php

namespace Ajax\semantic\html\collections;

use Ajax\bootstrap\html\HtmlLink;
use Ajax\common\html\HtmlCollection;
use Ajax\semantic\html\base\Pointing;
use Ajax\common\html\HtmlDoubleElement;

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
		$this->addItems($items);
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
		if(!$item instanceof HtmlMenu)
			$item->addToPropertyCtrl("class", "item",array("item"));
		else{
			$this->setSecondary();
		}
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

	public function setSecondary(){
		return $this->addToProperty("class", "secondary");
	}

	public function setVertical(){
		return $this->addToProperty("class", "vertical");
	}

	public function setPosition($value="right"){
		return $this->addToPropertyCtrl("class", $value,array("right","left"));
	}

	public function setPointing($value=Pointing::POINTING){
		return $this->addToPropertyCtrl("class", $value,Pointing::getConstants());
	}

	public function asTab($vertical=false){
		$this->apply(function(HtmlDoubleElement &$item){$item->setTagName("a");});
		if($vertical===true)
			$this->setVertical();
		return $this->addToProperty("class", "tabular");
	}

	public function asPagination(){
		$this->apply(function(HtmlDoubleElement &$item){$item->setTagName("a");});
			return $this->addToProperty("class", "pagination");
	}

	public function setFixed(){
		return $this->addToProperty("class", "fixed");
	}

	public function setFluid(){
		return $this->addToProperty("class", "fluid");
	}

	public function setCompact(){
		return $this->addToProperty("class", "compact");
	}
}