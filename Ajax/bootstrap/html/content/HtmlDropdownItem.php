<?php
use Ajax\JsUtils;
/**
 * Inner element for Twitter Bootstrap HTML Dropdown component
 * @author jc
 * @version 1.001
 */
class HtmlDropdownItem extends \BaseHtml {
	protected $_htmlDropdown;
	protected $class;
	protected $caption;
	protected $href;
	protected $role;
	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->class="";
		$this->caption="";
		$this->href="#";
		$this->role="";
		$this->_template='<li id="%identifier%" class="%class%" role="%role%"><a role="menuitem" tabindex="-1" href="%href%">%caption%</a></li>';
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
		if($value==="-"){
			$this->class="divider";
			$value="";
		}
		$this->caption=$value;
		return $this;
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

	public function run(JsUtils $js) {

	}
}