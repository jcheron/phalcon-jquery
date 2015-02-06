<?php
namespace Ajax\bootstrap\html;
use Ajax\bootstrap\html\base\HtmlDoubleElement;
class HtmlLink extends HtmlDoubleElement {
	public function __construct($identifier,$href="#",$content="Link") {
		parent::__construct ( $identifier,"a");
		$this->setHref($href);
		$this->content=$content;
	}

	public function setHref($value){
		$this->setProperty("href", $value);
	}

	public function getHref(){
		return $this->getProperty("href");
	}
	//TODO use Class Tag
}