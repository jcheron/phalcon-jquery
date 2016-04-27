<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\common\html\html5\HtmlImg;
use Ajax\common\html\HtmlDoubleElement;
use Ajax\semantic\html\base\constants\Direction;
use Ajax\semantic\html\base\traits\LabeledIconTrait;

class HtmlLabel extends HtmlSemDoubleElement {
	use LabeledIconTrait;
	public function __construct($identifier,$caption="",$icon=NULL,$tagName="div") {
		parent::__construct($identifier,$tagName,"ui label");
		$this->content=$caption;
		if(isset($icon))
			$this->addIcon($icon);
	}

	/**
	 * @param string $side
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function setPointing($value=Direction::NONE){
		return $this->addToPropertyCtrl("class", $value." pointing",Direction::getConstantValues("pointing"));
	}

	/**
	 * @param string $side
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function toCorner($side="left"){
		return $this->addToPropertyCtrl("class", $side." corner",array("right corner","left corner"));
	}

	/**
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function asTag(){
		return $this->addToProperty("class", "tag");
	}

	/**
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function asLink(){
		return $this->setTagName("a");
	}

	public function setBasic(){
		return $this->addToProperty("class", "basic");
	}

	/**
	 * Adds an image to emphasize
	 * @param string $src
	 * @param string $alt
	 * @param string $before
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function addImage($src,$alt="",$before=true){
		$this->addToProperty("class", "image");
		return $this->addContent(new HtmlImg("image-".$this->identifier,$src,$alt),$before);
	}

	/**
	 * @param string $detail
	 * @return \Ajax\common\html\HtmlDoubleElement
	 */
	public function addDetail($detail){
		$div=new HtmlDoubleElement("detail-".$this->identifier,$this->tagName);
		$div->setClass("detail");
		$div->setContent($detail);
		$this->addContent($div);
		return $div;
	}

	public function asRibbon(){
		return $this->addToPropertyCtrl("class", "ribbon", array("ribbon"));
	}

	public static function ribbon($identifier,$caption){
		return (new HtmlLabel($identifier,$caption))->asRibbon();
	}
}