<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\SegmentType;
use Ajax\semantic\html\base\TextAlignment;

/**
 * Semantic Segment element
 * @see http://semantic-ui.com/elements/segment.html
 * @author jc
 * @version 1.001
 */
class HtmlSegment extends HtmlSemDoubleElement {

	public function __construct($identifier, $content="") {
		parent::__construct($identifier, "div");
		$this->content=$content;
		$this->setClass("ui segment");
	}

	/**
	 * Defines the segment type
	 * @param string $type one of "raised","stacked","piled" default : ""
	 * @return \Ajax\semantic\html\elements\HtmlSegment
	 */
	public function setType($type){
		return $this->addToPropertyCtrl("class", $type, SegmentType::getConstants());
	}

	public function setSens($sens="vertical"){
		return $this->addToPropertyCtrl("class", $sens, array("vertical","horizontal"));
	}

	public function setInverted(){
		return $this->addToProperty("class", "inverted");
	}

	public function setAttached(){
		return $this->addToProperty("class", "attached");
	}

	public function setEmphasis($value="secondary"){
		return $this->addToPropertyCtrl("class", $value, array("secondary","tertiary",""));
	}

	public function setCircular(){
		return $this->addToProperty("class", "circular");
	}

	public function clear(){
		return $this->addToProperty("class", "clearing");
	}

	public function setFloating($value="left"){
		return $this->addToPropertyCtrl("class", "floated ".$value,array("floated right","floated left"));
	}

	public function setTextAlignment($value=TextAlignment::LEFT){
		return $this->addToPropertyCtrl("class", $value,TextAlignment::getConstants());
	}

	public function setCompact(){
		return $this->addToProperty("class", "compact");
	}

	public function setBasic(){
		return $this->setProperty("class", "ui basic segment");
	}

}