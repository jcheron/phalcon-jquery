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

class Semantic extends BaseGui {

	public function __construct($autoCompile=true) {
		parent::__construct($autoCompile=true);
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
				$group->addIcon($icon,$size);
			}
		}else{
			foreach ($icons as $icon){
				$group->addIcon($icon);
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

	public function htmlLabel($identifier,$content="",$tagName="div"){
		return $this->addHtmlComponent(new HtmlLabel($identifier, $content,$tagName));
	}
}