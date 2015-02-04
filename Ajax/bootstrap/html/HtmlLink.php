<?php
namespace Ajax\bootstrap\html;
class HtmlLink extends HtmlDoubleElement {
	public function __construct($identifier,$href="#",$content="Link") {
		parent::__construct ( $identifier,"a");
		$this->setHref($href);
		$this->content=$content;
	}

	public function setHref($value){
		$this->setProperty("href", $value);
	}
	//TODO use Class Tag
}