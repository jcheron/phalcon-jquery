<?php
namespace Ajax\bootstrap\html;
use Ajax\JsUtils;
use Ajax\bootstrap\html\base\BaseHtml;
use Ajax\bootstrap\html\base\HtmlDoubleElement;

/**
 * Inner element for Twitter Bootstrap HTML Navbar component
 * @author jc
 * @version 1.001
 */
class HtmlNavzone extends BaseHtml {
	protected $class="navbar-nav";
	protected $elements;

	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->tagName="ul";
		$this->_template='<%tagName% class="nav navbar-nav %class%">%elements%</%tagName%>';
		$this->elements=array();
	}

	public function setClass($value){
		$this->setMemberCtrl($this->class, $value, CssRef::navbarZoneClasses());
	}

	public function addElement($element){
		if(is_object($element)){
			$this->elements[]=$element;
		}else
			$this->addLink($element);;
	}

	public function setValues($class,$tagName,$elements=array()){
		$this->class=$class;
		$this->tagName=$tagName;
		$this->elements=$elements;
		return $this;
	}

	public function addElements($elements){
		if(is_array($elements)){
			foreach ($elements as $key=>$element){
				$iid=$this->getElementsCount()+1;
				if($element instanceof HtmlDropdownItem)
					$this->elements[]=$element;
				else if(is_array($element)){
					if(is_string($key)===true){
						$dropdown=new HtmlDropdown($this->identifier."-dropdown-".$iid);
						$dropdown->addItems($element);
						$dropdown->setBtnCaption($key);
						$dropdown->setMTagName("li");
						$this->addElement($dropdown);
					}else{
						$this->addLink($element[1],$element[0]);
					}
				}
				else if(is_string($element)){
					$this->addLink($element);
				}
				//TODO A vérifier
			}
		}
		return $this;
	}

	public function addLink($caption,$href="#"){
		$iid=$this->getElementsCount()+1;
		$li=new HtmlDoubleElement($this->identifier."-li-".$iid,"li");
		$link=new HtmlLink($this->identifier."-link-".$iid,$href,$caption);
		$li->setContent($link);
		$this->addElement($li);
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

	public function getElementsCount(){
		return sizeof($this->elements);
	}

	public function fromArray($array){
		return $this->addElements($array);
	}

	public function __toString(){
		return $this->compile();
	}
}