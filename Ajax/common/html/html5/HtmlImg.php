<?php

namespace Ajax\common\html\html5;


use Ajax\common\html\HtmlSingleElement;

class HtmlImg extends HtmlSingleElement {

	public function __construct($identifier) {
		parent::__construct($identifier, "img");
	}

	public function getSrc() {
		return $this->getProperty("src");
	}

	public function setSrc($src) {
		$this->setProperty("src", $src);
		return $this;
	}

	public function getAlt() {
		return $this->getProperty("alt");
	}

	public function setAlt($alt) {
		$this->setProperty("alt", $alt);
		return $this;
	}

	public function getTitle() {
		return $this->getProperty("title");
	}

	public function setTitle($title) {
		$this->setProperty("title", $title);
		return $this;
	}
}