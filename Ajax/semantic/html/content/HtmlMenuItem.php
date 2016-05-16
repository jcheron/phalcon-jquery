<?php

namespace Ajax\semantic\html\content;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\elements\HtmlIcon;

class HtmlMenuItem extends HtmlSemDoubleElement {
	protected $image;

	public function __construct($identifier, $content) {
		parent::__construct($identifier, "div", "item");
		$this->_template='<%tagName% id="%identifier%" %properties%>%image%%content%</%tagName%>';
		$this->content=$content;
	}

	public function addIcon($icon, $before=true) {
		$content=$this->content;
		$this->content=new HtmlSemDoubleElement("content-" . $this->identifier, "div", "content");
		$this->content->setContent($content);
		$this->content->addContent(new HtmlIcon("icon" . $this->identifier, $icon), $before);
	}
}