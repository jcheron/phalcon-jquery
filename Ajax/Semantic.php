<?php

namespace Ajax;

use Ajax\common\BaseGui;
use Ajax\semantic\html\elements\HtmlButton;
use Ajax\semantic\html\elements\HtmlIcon;
use Ajax\service\JArray;
use Ajax\semantic\html\elements\HtmlIconGroups;
use Ajax\semantic\html\elements\HtmlButtonGroups;
use Ajax\semantic\html\elements\HtmlContainer;
use Ajax\semantic\html\elements\HtmlDivider;
use Ajax\semantic\html\elements\HtmlLabel;
use Ajax\semantic\html\collections\menus\HtmlMenu;
use Ajax\semantic\components\Popup;
use Ajax\semantic\html\modules\HtmlDropdown;
use Ajax\semantic\components\Dropdown;
use Ajax\semantic\html\collections\HtmlMessage;
use Ajax\semantic\html\elements\HtmlSegment;
use Ajax\semantic\html\elements\HtmlSegmentGroups;
use Ajax\semantic\html\modules\HtmlPopup;
use Ajax\common\html\BaseHtml;
use Ajax\semantic\html\collections\HtmlGrid;
use Ajax\semantic\html\collections\menus\HtmlIconMenu;
use Ajax\semantic\html\collections\menus\HtmlLabeledIconMenu;
use Ajax\semantic\html\elements\HtmlHeader;
use Ajax\semantic\html\elements\HtmlInput;
use Ajax\semantic\html\elements\HtmlList;
use Ajax\common\components\GenericComponent;
use Ajax\semantic\html\collections\HtmlBreadcrumb;
use Ajax\semantic\html\modules\HtmlAccordion;
use Ajax\semantic\components\Accordion;
use Ajax\semantic\html\collections\menus\HtmlAccordionMenu;
use Ajax\semantic\html\collections\form\HtmlForm;

class Semantic extends BaseGui {

	public function __construct($autoCompile=true) {
		parent::__construct($autoCompile=true);
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
	public function popup($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Popup($this->js), $attachTo, $params);
	}

	public function dropdown($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	public function accordion($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Accordion($this->js), $attachTo, $params);
	}


	/**
	 * Return a new Semantic Html Button
	 * @param string $identifier
	 * @param string $value
	 * @param string $cssStyle
	 * @param string $onClick
	 * @return HtmlButton
	 */
	public function htmlButton($identifier, $value="", $cssStyle=null, $onClick=null) {
		return $this->addHtmlComponent(new HtmlButton($identifier, $value, $cssStyle, $onClick));
	}

	/**
	 * @param string $identifier
	 * @param string $icon
	 */
	public function htmlIcon($identifier,$icon){
		return $this->addHtmlComponent(new HtmlIcon($identifier, $icon));
	}

	/**
	 * @param string $identifier
	 * @param string $size
	 * @param array $icons
	 */
	public function htmlIconGroups($identifier,$size="",$icons=array()){
		$group=new HtmlIconGroups($identifier,$size);
		if(JArray::isAssociative($icons)){
			foreach ($icons as $icon=>$size){
				$group->add($icon,$size);
			}
		}else{
			foreach ($icons as $icon){
				$group->add($icon);
			}
		}
		return $this->addHtmlComponent($group);
	}

	/**
	 * @param string $identifier
	 * @param array $elements
	 * @param boolean $asIcons
	 */
	public function htmlButtonGroups($identifier,$elements=array(),$asIcons=false){
		return $this->addHtmlComponent(new HtmlButtonGroups($identifier, $elements,$asIcons));
	}

	/**
	 * Creates an html container
	 * @param string $identifier
	 * @param string $content
	 */
	public function htmlContainer($identifier,$content=""){
		return $this->addHtmlComponent(new HtmlContainer($identifier, $content));
	}

	/**
	 * @param string $identifier
	 * @param string $content
	 */
	public function htmlDivider($identifier,$content="",$tagName="div"){
		return $this->addHtmlComponent(new HtmlDivider($identifier, $content,$tagName));
	}

	/**
	 * @param string $identifier
	 * @param string $content
	 * @param string $tagName
	 */
	public function htmlLabel($identifier,$content="",$tagName="div"){
		return $this->addHtmlComponent(new HtmlLabel($identifier, $content,$tagName));
	}

	/**
	 * @param string $identifier
	 * @param array $items
	 * @return Ajax\semantic\html\collections\HtmlMenu
	 */
	public function htmlMenu($identifier,$items=array()){
		return $this->addHtmlComponent(new HtmlMenu($identifier,$items));
	}

	/**Adds an icon menu
	 * @param string $identifier
	 * @param array $items icons
	 */
	public function htmlIconMenu($identifier,$items=array()){
		return $this->addHtmlComponent(new HtmlIconMenu($identifier,$items));
	}

	/**Adds an labeled icon menu
	 * @param string $identifier
	 * @param array $items icons
	 */
	public function htmlLabeledIconMenu($identifier,$items=array()){
		return $this->addHtmlComponent(new HtmlLabeledIconMenu($identifier,$items));
	}

	/**
	 * @param string $identifier
	 * @param string $value
	 * @param array $items
	 */
	public function htmlDropdown($identifier, $value="", $items=array()){
		return $this->addHtmlComponent(new HtmlDropdown($identifier,$value,$items));
	}

	/**
	 * Adds a new message
	 * @param string $identifier
	 * @param string $content
	 */
	public function htmlMessage($identifier, $content=""){
		return $this->addHtmlComponent(new HtmlMessage($identifier,$content));
	}

	/**
	 * Adds a new segment, used to create a grouping of related content
	 * @param string $identifier
	 * @param string $content
	 */
	public function htmlSegment($identifier, $content=""){
		return $this->addHtmlComponent(new HtmlSegment($identifier,$content));
	}

	/**
	 * Adds a group of segments
	 * @param string $identifier
	 * @param array $items the segments
	 */
	public function htmlSegmentGroups($identifier, $items=array()){
		return $this->addHtmlComponent(new HtmlSegmentGroups($identifier,$items));
	}

	/**
	 * @param string $identifier
	 * @param mixed $content
	 */
	public function htmlPopup(BaseHtml $container,$identifier,$content){
		return $this->addHtmlComponent(new HtmlPopup($container,$identifier,$content));
	}

	/**
	 * @param string $identifier
	 * @param int $numRows
	 * @param int $numCols
	 * @param boolean $createCols
	 * @param boolean $implicitRows
	 */
	public function htmlGrid($identifier,$numRows=1,$numCols=NULL,$createCols=true,$implicitRows=false){
		return $this->addHtmlComponent(new HtmlGrid($identifier,$numRows,$numCols,$createCols,$implicitRows));
	}

	/**
	 * @param string $identifier
	 * @param number $niveau
	 * @param mixed $content
	 * @param string $type
	 */
	public function htmlHeader($identifier,$niveau=1,$content=NULL,$type="page"){
		return $this->addHtmlComponent(new HtmlHeader($identifier,$niveau,$content,$type));
	}

	public function htmlInput($identifier,$type="text",$value="",$placeholder=""){
		return $this->addHtmlComponent(new HtmlInput($identifier,$type,$value,$placeholder));
	}

	public function htmlList($identifier,$items=array()){
		return $this->addHtmlComponent(new HtmlList($identifier,$items));
	}

	/**
	 * Return a new Semantic Html Breadcrumb
	 * @param string $identifier
	 * @param array $elements
	 * @param boolean $autoActive sets the last element's class to <b>active</b> if true. default : true
	 * @param function $hrefFunction the function who generates the href elements. default : function($e){return $e->getContent()}
	 * @return HtmlBreadcrumb
	 */
	public function htmlBreadcrumb( $identifier,$items=array(),$autoActive=true,$startIndex=0,$hrefFunction=NULL){
		return $this->addHtmlComponent(new HtmlBreadcrumb($identifier,$items,$autoActive,$startIndex,$hrefFunction));
	}

	/**
	 * Return a new Semantic Accordion
	 * @param string $identifier
	 * @return HtmlAccordion
	 */
	public function htmlAccordion($identifier) {
		return $this->addHtmlComponent(new HtmlAccordion($identifier));
	}

	/**
	 * Return a new Semantic Menu Accordion
	 * @param string $identifier
	 * @return HtmlAccordion
	 */
	public function htmlAccordionMenu($identifier,$items=array()) {
		return $this->addHtmlComponent(new HtmlAccordionMenu($identifier,$items));
	}

	/**
	 * Return a new Semantic Form
	 * @param string $identifier
	 * @param array $elements
	 */
	public function htmlForm($identifier,$elements=array()) {
		return $this->addHtmlComponent(new HtmlForm($identifier,$elements));
	}
}