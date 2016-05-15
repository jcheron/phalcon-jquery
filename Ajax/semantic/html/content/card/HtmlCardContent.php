<?php

namespace Ajax\semantic\html\content\card;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\constants\Direction;

class HtmlCardContent extends HtmlSemDoubleElement {

	public function __construct($identifier, $content=array()) {
		parent::__construct($identifier, "div", "content", $content);
	}

	public function addMeta($value, $direction=Direction::LEFT) {
		if (\array_key_exists("meta", $this->content) === false) {
			$this->content["meta"]=array ();
		}
		$meta=new HtmlSemDoubleElement("meta-" . \sizeof($this->content["meta"]) . "" . $this->identifier, "div", "meta", $value);
		$this->content["meta"][]=$meta;
		$meta->setFloated($direction);
		return $meta;
	}

	public function addContentIcon($icon, $caption=NULL, $direction=Direction::LEFT) {
		if ($direction === Direction::RIGHT) {
			$result=new HtmlSemDoubleElement("", "span", "", $caption);
			$result->setFloated($direction);
			$result->addIcon($icon);
			$this->addContent($result);
		} else {
			$this->addIcon($icon);
			$result=$this->addContent($caption);
		}
		return $result;
	}
}