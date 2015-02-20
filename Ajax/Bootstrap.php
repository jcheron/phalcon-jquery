<?php
namespace Ajax;
use Ajax\common\BaseGui;
use Ajax\bootstrap\Components\Modal;
use Ajax\bootstrap\Components\Tooltip;
use Ajax\bootstrap\Components\Dropdown;
use Ajax\bootstrap\Components\Tab;
use Ajax\bootstrap\Components\Collapse;
use Ajax\bootstrap\Components\Carousel;
use Ajax\bootstrap\Components\GenericComponent;
use Ajax\bootstrap\html\HtmlButton;
use Ajax\bootstrap\html\HtmlButtongroups;
use Ajax\bootstrap\html\HtmlGlyphButton;
use Ajax\bootstrap\html\HtmlDropdown;
use Ajax\bootstrap\Components\Splitbutton;
use Ajax\bootstrap\html\HtmlButtontoolbar;
use Ajax\bootstrap\html\HtmlNavbar;
include_once 'bootstrap/js/Draggable.php';
include_once 'common/JsCode.php';

class Bootstrap extends BaseGui{

	public function __construct($autoCompile = true) {
		parent::__construct($autoCompile);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function generic($attachTo=NULL,$params=NULL){
		return $this->addComponent(new GenericComponent($this->js), $attachTo, $params);
	}
	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function modal($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Modal($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function tooltip($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tooltip($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function dropdown($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function splitbutton($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Splitbutton($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function tab($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tab($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function collapse($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Collapse($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function carousel($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Carousel($this->js), $attachTo, $params);
	}

	/**
	 * Return a new Bootstrap Html Button
	 * @param string $identifier
	 * @param string $value
	 * @param string $cssStyle
	 * @param string $onClick
	 * @return HtmlButton
	 */
	public function htmlButton($identifier, $value="",$cssStyle=null,$onClick=null){
		$button=new HtmlButton($identifier,$value,$cssStyle,$onClick);
		return $this->addHtmlComponent($button);
	}

	/**
	 * Return a new Bootstrap Html Glyphbutton
	 * @param string $identifier
	 * @param mixed $glyphIcon
	 * @param string $value
	 * @param string $cssStyle
	 * @param string $onClick
	 * @return HtmlGlyphButton
	 */
	public function htmlGlyphButton($identifier,$glyphIcon=0, $value="",$cssStyle=NULL,$onClick=NULL){
		$button=new HtmlGlyphButton($identifier,$glyphIcon,$value,$cssStyle,$onClick);
		return $this->addHtmlComponent($button);
	}

	/**
	 * Return a new Bootstrap Html Buttongroups
	 * @param string $identifier
	 * @param array $values
	 * @param string $cssStyle
	 * @param string $size
	 * @return HtmlButtongroups
	 */
	public function htmlButtongroups($identifier, $values=array(),$cssStyle=NULL,$size=NULL){
		$buttongroup=new HtmlButtongroups($identifier,$values,$cssStyle,$size);
		return $this->addHtmlComponent($buttongroup);
	}

	/**
	 * Return a new Bootstrap Html Dropdown
	 * @param string $identifier
	 * @param array $items
	 * @param string $cssStyle
	 * @param string $size
	 * @return HtmlDropdown
	 */
	public function htmlDropdown($identifier, $value="",$items=array(),$cssStyle=NULL,$size=NULL){
		$button=new HtmlDropdown($identifier,$value,$items,$cssStyle,$size);
		return $this->addHtmlComponent($button);
	}

	/**
	 * Return a new Bootstrap Html Dropdown
	 * @param string $identifier
	 * @param array $elements
	 * @param string $cssStyle
	 * @param string $size
	 * @return HtmlButtontoolbar
	 */
	public function htmlButtontoolbar($identifier,$elements=array(),$cssStyle=NULL,$size=NULL){
		$button=new HtmlButtontoolbar($identifier,$elements,$cssStyle,$size);
		return $this->addHtmlComponent($button);
	}

	/**
	 * Return a new Bootstrap Html Navbar
	 * @param string $identifier
	 * @param string $brand
	 * @param string $brandHref
	 * @return HtmlNavbar
	 */
	public function htmlNavbar($identifier,$brand="Brand",$brandHref="#"){
		$nav=new HtmlNavbar($identifier,$brand,$brandHref);
		return $this->addHtmlComponent($nav);
	}
}