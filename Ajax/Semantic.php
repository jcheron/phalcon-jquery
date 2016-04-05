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
use Ajax\semantic\html\collections\HtmlMenu;
use Ajax\semantic\components\Popup;
use Ajax\semantic\html\modules\HtmlDropdown;
use Ajax\semantic\components\Dropdown;
use Ajax\semantic\html\collections\HtmlMessage;
use Ajax\semantic\html\elements\HtmlSegment;
use Ajax\semantic\html\elements\HtmlSegmentGroups;
use Ajax\common\html\HtmlDoubleElement;
use Ajax\semantic\html\modules\HtmlPopup;
use Ajax\common\html\BaseHtml;

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
	public function popup($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Popup($this->js), $attachTo, $params);
	}

	public function dropdown($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
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
	 */
	public function htmlMenu($identifier,$items=array()){
		return $this->addHtmlComponent(new HtmlMenu($identifier,$items));
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
}