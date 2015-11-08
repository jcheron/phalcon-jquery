<?php

namespace Ajax;

use Ajax\common\BaseGui;
use Ajax\bootstrap\components\Modal;
use Ajax\bootstrap\components\Tooltip;
use Ajax\bootstrap\components\Dropdown;
use Ajax\bootstrap\components\Tab;
use Ajax\bootstrap\components\Collapse;
use Ajax\bootstrap\components\Carousel;
use Ajax\bootstrap\components\GenericComponent;
use Ajax\bootstrap\html\HtmlButton;
use Ajax\bootstrap\html\HtmlButtongroups;
use Ajax\bootstrap\html\HtmlGlyphButton;
use Ajax\bootstrap\html\HtmlDropdown;
use Ajax\bootstrap\components\Splitbutton;
use Ajax\bootstrap\html\HtmlButtontoolbar;
use Ajax\bootstrap\html\HtmlNavbar;
use Ajax\bootstrap\html\HtmlProgressbar;
use Ajax\bootstrap\components\Popover;
use Ajax\bootstrap\html\HtmlPanel;
use Ajax\bootstrap\html\HtmlAlert;
use Ajax\bootstrap\html\HtmlAccordion;
use Ajax\bootstrap\html\HtmlCarousel;
use Ajax\bootstrap\html\HtmlTabs;
use Ajax\bootstrap\html\HtmlModal;
use Ajax\bootstrap\html\HtmlSplitbutton;
use Ajax\bootstrap\html\HtmlInputgroup;

class Bootstrap extends BaseGui {

	public function __construct($autoCompile=true) {
		parent::__construct($autoCompile);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function generic($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new GenericComponent($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function modal($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Modal($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function tooltip($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tooltip($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function popover($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Popover($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function dropdown($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function splitbutton($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Splitbutton($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function tab($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tab($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function collapse($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Collapse($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function carousel($attachTo=NULL, $params=NULL) {
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
	public function htmlButton($identifier, $value="", $cssStyle=null, $onClick=null) {
		$button=new HtmlButton($identifier, $value, $cssStyle, $onClick);
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
	public function htmlGlyphButton($identifier, $glyphIcon=0, $value="", $cssStyle=NULL, $onClick=NULL) {
		$button=new HtmlGlyphButton($identifier, $glyphIcon, $value, $cssStyle, $onClick);
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
	public function htmlButtongroups($identifier, $values=array(), $cssStyle=NULL, $size=NULL) {
		$buttongroup=new HtmlButtongroups($identifier, $values, $cssStyle, $size);
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
	public function htmlDropdown($identifier, $value="", $items=array(), $cssStyle=NULL, $size=NULL) {
		$button=new HtmlDropdown($identifier, $value, $items, $cssStyle, $size);
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
	public function htmlButtontoolbar($identifier, $elements=array(), $cssStyle=NULL, $size=NULL) {
		$button=new HtmlButtontoolbar($identifier, $elements, $cssStyle, $size);
		return $this->addHtmlComponent($button);
	}

	/**
	 * Return a new Bootstrap Html Navbar
	 * @param string $identifier
	 * @param string $brand
	 * @param string $brandHref
	 * @return HtmlNavbar
	 */
	public function htmlNavbar($identifier, $brand="Brand", $brandHref="#") {
		$nav=new HtmlNavbar($identifier, $brand, $brandHref);
		return $this->addHtmlComponent($nav);
	}

	/**
	 * Return a new Bootstrap Html Progressbar
	 * @param string $identifier
	 * @param string $value
	 * @param string $max
	 * @param string $min
	 * @return HtmlProgressbar
	 */
	public function htmlProgressbar($identifier, $style="info", $value=0, $max=100, $min=0) {
		$pb=new HtmlProgressbar($identifier, $style, $value, $max, $min);
		return $this->addHtmlComponent($pb);
	}

	/**
	 * Return a new Bootstrap Html Panel
	 * @param string $identifier the Html identifier of the element
	 * @param mixed $content the panel content (string or HtmlComponent)
	 * @param string $header the header
	 * @param string $footer the footer
	 * @return HtmlPanel
	 */
	public function htmlPanel($identifier, $content=NULL, $header=NULL, $footer=NULL) {
		$panel=new HtmlPanel($identifier, $content, $header, $footer);
		return $this->addHtmlComponent($panel);
	}

	/**
	 * Return a new Bootstrap Html Alert
	 * @param string $identifier
	 * @param string $message
	 * @param string $cssStyle
	 * @return HtmlAlert
	 */
	public function htmlAlert($identifier, $message=NULL, $cssStyle="alert-warning") {
		$alert=new HtmlAlert($identifier, $message, $cssStyle);
		return $this->addHtmlComponent($alert);
	}

	/**
	 * Return a new Bootstrap Accordion
	 * @param string $identifier
	 * @return HtmlAccordion
	 */
	public function htmlAccordion($identifier) {
		$accordion=new HtmlAccordion($identifier);
		return $this->addHtmlComponent($accordion);
	}

	/**
	 * Return a new Bootstrap Html Carousel
	 * @param string $identifier
	 * @param array $images [(src=>"",alt=>"",caption=>"",description=>""),...]
	 * @return HtmlCarousel
	 */
	public function htmlCarousel($identifier, $images=NULL) {
		$caroussel=new HtmlCarousel($identifier, $images);
		return $this->addHtmlComponent($caroussel);
	}

	/**
	 * Return a new Bootstrap Html tabs
	 * @param string $identifier
	 * @return HtmlTabs
	 */
	public function htmlTabs($identifier) {
		$tabs=new HtmlTabs($identifier);
		return $this->addHtmlComponent($tabs);
	}

	/**
	 * Return a new Bootstrap Html modal dialog
	 * @param string $identifier
	 * @param string $title
	 * @param string $content
	 * @param array $buttonCaptions
	 * @return HtmlModal
	 */
	public function htmlModal($identifier, $title="", $content="", $buttonCaptions=array()) {
		$modal=new HtmlModal($identifier, $title, $content, $buttonCaptions);
		return $this->addHtmlComponent($modal);
	}

	/**
	 * Return a new Bootstrap Html SplitButton
	 * @param string $identifier
	 * @param string $value
	 * @param array $items
	 * @param string $cssStyle
	 * @param string $onClick
	 * @return HtmlSplitbutton
	 */
	public function htmlSplitbutton($identifier,$value="", $items=array(), $cssStyle="btn-default", $onClick=NULL) {
		$split=new HtmlSplitbutton($identifier, $value, $items, $cssStyle,$onClick);
		return $this->addHtmlComponent($split);
	}

	/**
	 * Return a new Bootstrap Html InputGroup
	 * @param string $identifier
	 * @return HtmlInputgroup
	 */
	public function htmlInputgroup($identifier){
		$inputGroup=new HtmlInputgroup($identifier);
		return $this->addHtmlComponent($inputGroup);
	}
}