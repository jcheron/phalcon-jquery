<?php
use Ajax\JsUtils;
include_once 'content/HtmlDropdownItem.php';

/**
 * Twitter Bootstrap HTML Modal component
 * @author jc
 * @version 1.001
 */
class HtmlDropdown extends \BaseHtml {
	protected $btnCaption="Dropdown button";
	protected $class="dropdown-toggle";
	protected $mTagName="div";
	protected $items=array();
	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplDropdown.php';
		$this->tagName="a";
		$this->items=array();
	}
	public function setMTagName($value){
		$this->mTagName=$value;
	}
	public function addItem($caption,$href="#"){
		$nb=sizeof($this->items)+1;
		$item=new HtmlDropdownItem($this->identifier."-mnitem-".$nb);
		$item->setCaption($caption)->setHref($href);
		$this->items[]=$item;
		return $this;
	}

	public function addDivider(){
		return $this->addItem("-");
	}

	public function addItems($items){
		if(is_array($items)){
			foreach ($items as $item){
				if($item instanceof HtmlDropdownItem)
					$this->items[]=$item;
				else if(is_string($item))
					$this->addItem($item);
			}
		}
	}

	public function setItems($items){
		$this->items=array();
		$this->addItems($items);
	}

	public function setBtnClass($value){
		$this->addToMemberCtrl($this->class, $value, CssRef::buttonStyles());
	}

	/* (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->dropdown("#".$this->identifier);
		return $this->_bsComponent;
	}

	public function setTagName($tagName) {
		if($tagName=="button")
			$this->class="btn";
		return parent::setTagName($tagName);
	}

	public function __toString(){
		return $this->compile();
	}
	public function setBtnCaption($btnCaption) {
		$this->btnCaption = $btnCaption;
		return $this;
	}

}