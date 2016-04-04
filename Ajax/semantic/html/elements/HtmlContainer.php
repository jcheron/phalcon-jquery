<?php

namespace Ajax\semantic\html\elements;

use Ajax\common\html\HtmlDoubleElement;
/**
 * Semantic UI container component
 * @see http://semantic-ui.com/elements/container.html#/definition
 * @author jc
 * @version 1.001
 */
class HtmlContainer extends HtmlDoubleElement {

	public function __construct($identifier, $content="") {
		parent::__construct($identifier, "div");
		$this->content=$content;
		$this->setProperty("class", "ui container");
	}

	public function setFluid(){
		return $this->addToProperty("class", "fluid");
	}

	public function setAlignement($value="justified"){
		if($value!=="justified")
			$value.=" aligned";
		return $this->addToProperty("class", $value);
	}

	public function setTextContainer(){
		return $this->addToProperty("class", "text");
	}
}