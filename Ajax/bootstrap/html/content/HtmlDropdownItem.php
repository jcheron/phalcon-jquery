<?php
namespace Ajax\bootstrap\html\content;
use Ajax\JsUtils;
use Phalcon\Text;
use Ajax\bootstrap\html\base\BaseHtml;
use Ajax\bootstrap\html\HtmlBadge;
use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\bootstrap\html\HtmlGlyphicon;
/**
 * Inner element for Twitter Bootstrap HTML Dropdown component
 * @author jc
 * @version 1.001
 */
class HtmlDropdownItem extends HtmlDoubleElement {
	protected $_htmlDropdown;
	protected $class;
	protected $itemClass;
	protected $href;
	protected $role;
	protected $itemRole;
	protected $target;
	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->class="";
		$this->btnClass="";
		$this->content="";
		$this->href="#";
		$this->role="menuitem";
		$this->target="_self";
		$this->_template='<li id="%identifier%" class="%class%" role="%role%"><a role="%itemRole%" class="%itemClass%" tabindex="-1" href="%href%" target="%target%">%content%</a></li>';
	}


	public function setItemClass($itemClass) {
		$this->itemClass = $itemClass;
		return $this;
	}

	public function setItemRole($itemRole) {
		$this->itemRole = $itemRole;
		return $this;
	}


	/**
	 * Set the item class
	 * @param string $value
	 * @return $this
	 * default : ''
	 */
	public function setClass($value){
		$this->class=$value;
		return $this;
	}

	/**
	 * Set the item caption
	 * @param string $value
	 * @return $this
	 */
	public function setCaption($value){
		if(Text::startsWith($value, "-")){
			$this->class="dropdown-header";
			$this->role="presentation";
			$this->_template='<li id="%identifier%" class="%class%" role="%role%">%content%</li>';
			if($value==="-"){
				$this->class="divider";
			}
			$value=substr($value, 1);
		}
		$this->content=$value;
		return $this;
	}

	public function disable(){
		$this->role="presentation";
		$this->class="disabled";
	}

	/**
	 * Set the item href
	 * @param string $value
	 * @return $this
	 * default : '#'
	 */
	public function setHref($value){
		$this->href=$value;
		return $this;
	}

	/**
	 * Set the item role
	 * @param string $value
	 * @return $this
	 * default : ''
	 */
	public function setRole($value){
		$this->role=$value;
		return $this;
	}

	public function isDivider(){
		return $this->class==="divider";
	}

	public function __toString(){
		return $this->compile();
	}

	/**
	/* Initialise l'objet à partir d'un tableau associatif
	 * array("identifier"=>"id","caption"=>"","class"=>"","href"=>"","role"=>"")
	 * @see BaseHtml::addProperties()
	 */
	public function fromArray($array) {
		return parent::fromArray($array);
	}

	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->generic("#".$this->identifier);
		$this->addEventsOnRun();
		return $this->_bsComponent;
	}

	/**
	 * Js component creation when dropdownItem is in Navs/Pills
	 * @param JsUtils $js
	 */
	public function runNav(JsUtils $js){
		$js->bootstrap()->tab("#".$this->identifier);
	}

	public function getHref() {
		return $this->href;
	}
	public function addBadge($caption,$leftSeparator="&nbsp;"){
		$badge=new HtmlBadge("badge-".$this->identifier);
		$badge->setContent($caption);
		$this->content.=$leftSeparator.$badge->compile();
		return $this;
	}

	public function addGlyph($glyphicon,$left=true,$separator="&nbsp;"){
		$glyph=new HtmlGlyphicon("glyph-".$this->identifier);
		$glyph->setGlyphicon($glyphicon);
		if($left){
			$this->content=$glyph->compile().$separator.$this->content;
		}else{
			$this->content.=$separator.$glyph->compile();
		}
		return $this;
	}

	public function getTarget() {
		return $this->target;
	}
	public function setTarget($target) {
		$this->target = $target;
		return $this;
	}

	public function onClick($jsCode,$stopPropagation=false,$preventDefault=false){
		if($stopPropagation===true){
			$jsCode="e.stopPropagation();".$jsCode;
		}
		if($preventDefault===true){
			$jsCode="e.preventDefault();".$jsCode;
		}
		$this->events["click"]=$jsCode;
		return $this;
	}


}