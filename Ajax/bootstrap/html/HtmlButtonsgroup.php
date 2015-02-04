<?php
namespace Ajax\bootstrap\html;
use Ajax\JsUtils;
/**
 * Composant Twitter Bootstrap Buttonsgroup
 * @author jc
 * @version 1.001
 */
class HtmlButtonsgroup extends HtmlDoubleElement {
	protected $elements;

	public function __construct($identifier, $tagName = "div") {
		parent::__construct ($identifier, $tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%elements%</%tagName%>";
		$this->setProperty("class", "btn-group");
		$this->setRole("group");
	}

	/**
	 * define the buttons size
	 * available values : "btn-group-lg","","btn-group-sm","btn-group-xs"
	 * @param string/int $size
	 * @return \Ajax\bootstrap\html\HtmlButtonsgroup
	 * default : ""
	 */
	public function setSize($size){
		if(is_int($size)){
			return $this->addToProperty("class", CssRef::sizes("btn-group")[$size]);
		}
		return $this->addToPropertyCtrl("class", $size, CssRef::sizes("btn-group"));
	}

	public function setStyle($value){
		foreach ($this->elements as $element)
			$element->setStyle($value);
	}

	public function addElement($element){
		$iid=sizeof($this->elements)+1;
		if($element instanceof HtmlButton){
			$this->elements[]=$element;
		}elseif (is_array($element)){
			if(array_key_exists("glyph", $element))
				$bt=new HtmlGlyphButton($this->identifier."-button-".$iid);
			elseif(array_key_exists("btnCaption", $element)){
				$bt=new HtmlDropdown($this->identifier."-dropdown-".$iid);
				$bt->setMTagName("div");
				$bt->setRole("group");
				$bt->setmClass("btn-group");
				$bt->setTagName("button");
				$bt->addBtnClass("dropdown-toogle");
				$bt->addBtnClass("btn-default");

			}else
				$bt=new HtmlButton($this->identifier."-button-".$iid);
			$bt->fromArray($element);
			$this->elements[]=$bt;

		}elseif(is_string($element)){
			$bt=new HtmlButton($this->identifier."-button-".$iid);
			$bt->setValue($element);
			$this->elements[]=$bt;
		}
	}

	public function setElements($elements){
		foreach ($elements as $element){
			$this->addElement($element);
		}
		return $this;
	}


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::fromArray()
	 */
	public function fromArray($array) {
		$this->setElements($array);

	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		foreach ($this->elements as $element){
			$element->run($js);
		}

	}


}