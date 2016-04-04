<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
/**
 * Semantic Icons group component
 * @see http://semantic-ui.com/elements/icon.html#/definition
 * @author jc
 * @version 1.001
 */
class HtmlIconGroups extends HtmlSemDoubleElement {

	public function __construct($identifier,$size="") {
		parent::__construct($identifier, "i");
		$this->setProperty("class", "icons");
		$this->setSize($size);
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