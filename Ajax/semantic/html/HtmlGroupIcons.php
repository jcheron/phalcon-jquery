<?php

namespace Ajax\semantic\html;

use Ajax\common\html\HtmlDoubleElement;
use Ajax\semantic\html\base\IconSize;
/**
 * Semantic Icons group component
 * @see http://semantic-ui.com/elements/icon.html#/definition
 * @author jc
 * @version 1.001
 */
class HtmlGroupIcons extends HtmlDoubleElement {

	public function __construct($identifier,$size="") {
		parent::__construct($identifier, "i");
		$this->setProperty("class", "icons");
		$this->setSize($size);
	}

	public function setSize($size){
		return $this->addToPropertyCtrl("class", $size, IconSize::getConstants());
	}

	public function addIcon($icon,$size=""){
		$iconO=$icon;
		if(\is_string($icon)){
			$iconO=new HtmlIcon("icon-".$this->identifier, $icon);
			$iconO->setSize($size);
		}
		$this->addContent($iconO);
	}

	public function getIcon($index){
		return $this->content[$index];
	}
}