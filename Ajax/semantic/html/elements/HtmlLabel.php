<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\common\html\html5\HtmlImg;
use Ajax\common\html\HtmlDoubleElement;

class HtmlLabel extends HtmlSemDoubleElement {

	public function __construct($identifier,$caption="",$tagName="div") {
		parent::__construct($identifier,$tagName);
		$this->setProperty("class", "ui label");
		$this->content=$caption;
	}

	/**
	 * @param string $side
	 * @return \Ajax\semantic\html\elements\HtmlLabel
	 */
	public function setPointing($side=""){
		return $this->addToPropertyCtrl("class", $side." pointing",array("right pointing","left pointing"," pointing"));
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

	public function setBasic(){
		return $this->addToProperty("class", "basic");
	}

	/**
	 * Adds an icon before or after
	 * @param string|HtmlIcon $icon
	 * @param boolean $before
	 * @return \Ajax\semantic\html\elements\HtmlIcon
	 */
	public function addIcon($icon,$before=true){
		$iconO=$icon;
		if(\is_string($icon)){
			$iconO=new HtmlIcon("icon-".$this->identifier, $icon);
		}
		$this->addContent($iconO,$before);
		return $iconO;
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
}