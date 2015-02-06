<?php
namespace Ajax\bootstrap\html\content;
use Ajax\JsUtils;
use Phalcon\Text;
use Ajax\bootstrap\html\base\BaseHtml;
use Ajax\bootstrap\html\HtmlBadge;
/**
 * Inner element for Twitter Bootstrap HTML Dropdown component
 * @author jc
 * @version 1.001
 */
class HtmlDropdownItem extends BaseHtml {
	protected $_htmlDropdown;
	protected $class;
	protected $itemClass;
	protected $caption;
	protected $href;
	protected $role;
	protected $itemRole;
	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->class="";
		$this->btnClass="";
		$this->caption="";
		$this->href="#";
		$this->role="menuitem";
		$this->_template='<li id="%identifier%" class="%class%" role="%role%"><a role="%itemRole%" class="%itemClass%" tabindex="-1" href="%href%">%caption%</a></li>';
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
			$this->_template='<li id="%identifier%" class="%class%" role="%role%">%caption%</li>';
			if($value==="-"){
				$this->class="divider";
			}
			$value=substr($value, 1);
		}
		$this->caption=$value;
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
		$this->caption.=$leftSeparator.$badge->compile();
	}
}