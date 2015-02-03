<?php
use Ajax\JsUtils;
/**
 * Inner element for Twitter Bootstrap HTML Navbar component
 * @author jc
 * @version 1.001
 */
class HtmlNavzone extends \BaseHtml {
	protected $class="navbar-nav";
	protected $elements;

	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->tagName="ul";
		$this->_template='<%tagName% class="nav %class%">%elements%</%tagName%>';
		$this->elements=array();
	}

	public function setClass($value){
		$this->setMemberCtrl($this->class, $value, CssRef::navbarZoneClasses());
	}

	public function addElement($element){
		$this->elements[]=$element;
	}

	public function setValues($class,$tagName,$elements=array()){
		$this->class=$class;
		$this->tagName=$tagName;
		$this->elements=$elements;
		return $this;
	}

	public static function form($identifier,$elements=array()){
		$result=new HtmlNavzone($identifier);
		return $result->setValues("navbar-form navbar-left", "form",$elements);
	}

	public static function left($identifier,$elements=array()){
		$result=new HtmlNavzone($identifier);
		return $result->setValues("navbar-left", "ul",$elements);
	}

	public static function right($identifier,$elements=array()){
		$result=new HtmlNavzone($identifier);
		return $result->setValues("navbar-right", "ul",$elements);
	}

	public static function nav($identifier,$elements=array()){
		$result=new HtmlNavzone($identifier);
		return $result->setValues("navbar-nav", "ul",$elements);
	}

	public function run(JsUtils $js) {
		foreach ($this->elements as $element){
			$element->run($js);
		}
	}

	public function __toString(){
		return $this->compile();
	}
}