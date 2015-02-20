<?php
namespace Ajax\bootstrap\html;
use Ajax\JsUtils;
use Ajax\bootstrap\html\base\CssRef;
use Ajax\bootstrap\html\base\HtmlDoubleElement;
/**
 * Composant Twitter Bootstrap Buttongroups
 * @author jc
 * @version 1.001
 */
class HtmlButtongroups extends HtmlDoubleElement {
	protected $elements;

	public function __construct($identifier, $elements=array(),$cssStyle=NULL,$size=NULL,$tagName = "div") {
		parent::__construct ($identifier, $tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%elements%</%tagName%>";
		$this->setProperty("class", "btn-group");
		$this->setRole("group");
		$this->addElements($elements);
		if(isset($cssStyle)){
			$this->setStyle($cssStyle);
		}
		if (isset($size)){
			$this->setSize($size);
		}
	}

	/**
	 * define the buttons size
	 * available values : "btn-group-lg","","btn-group-sm","btn-group-xs"
	 * @param string/int $size
	 * @return \Ajax\bootstrap\html\HtmlButtonsgroup
	 * default : ""
	 */
	public function setSize($size){
		foreach ($this->elements as $element){
				$element->setSize($size);
		}
		if(is_int($size)){
			return $this->addToPropertyUnique("class", CssRef::sizes("btn-group")[$size],CssRef::sizes("btn-group"));
		}
		return $this->addToPropertyCtrl("class", $size, CssRef::sizes("btn-group"));
	}

	public function setStyle($value){
		foreach ($this->elements as $element)
			$element->setStyle($value);
	}

	public function addElement($element){
		$result=$element;
		$iid=sizeof($this->elements)+1;
		if($element instanceof HtmlButton){
			$this->elements[]=$element;
		}elseif (is_array($element)){
			if(array_key_exists("glyph", $element))
				$bt=new HtmlGlyphButton($this->identifier."-button-".$iid);
			elseif(array_key_exists("btnCaption", $element)){
				if(array_key_exists("split", $element))
					$bt=new HtmlSplitbutton($this->identifier."-dropdown-".$iid);
				else
					$bt=new HtmlDropdown($this->identifier."-dropdown-".$iid);
				$bt->setMTagName("div");
				$bt->setRole("group");
				$bt->setMClass("btn-group");
				$bt->setTagName("button");
				$bt->addBtnClass("dropdown-toogle");
				$bt->addBtnClass("btn-default");
			}else
				$bt=new HtmlButton($this->identifier."-button-".$iid);
			$bt->fromArray($element);
			$this->elements[]=$bt;
			$result=$bt;
		}elseif(is_string($element)){
			$bt=new HtmlButton($this->identifier."-button-".$iid);
			$bt->setValue($element);
			$this->elements[]=$bt;
			$result=$bt;
		}
		return $result;
	}

	public function addElements($elements){
		foreach ($elements as $element){
			$this->addElement($element);
		}
		return $this;
	}


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::fromArray()
	 */
	public function fromArray($array) {
		$this->addElements($array);

	}

	public function setAlignment($value){
		if(is_int($value)){
			$value=CssRef::alignment("btn-group")[$value];
		}else
			$value="btn-group-".$value;
		if(strstr($value, "justified")){
			foreach ($this->elements as $element){
				$element->wrap('<div class="btn-group" role="group">','</div>');
			}
		}
		$this->addToPropertyCtrl("class", $value, CssRef::alignment("btn-group-"));
	}

	/**
	 * Return the element at index
	 * @param int $index
	 * @return HtmlButton
	 */
	public function getElement($index){
		return $this->elements[$index];
	}

	public function setElement($index,$button){
		$this->elements[$index]=$button;
		return $this;
	}

	/**
	 * @param string $jsCode
	 * @param string $stopPropagation
	 * @param string $preventDefault
	 */
	public function onClick($jsCode,$stopPropagation=false,$preventDefault=false){
		foreach ($this->elements as $element){
			$element->onClick($jsCode,$stopPropagation,$preventDefault);
		}
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::on()
	 */
	public function on($event,$jsCode,$stopPropagation=false,$preventDefault=false){
			foreach ($this->elements as $element){
			$element->on($event,$jsCode,$stopPropagation,$preventDefault);
		}
	}
}