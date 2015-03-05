<?php

namespace Ajax\bootstrap\html\phalcon;

use Phalcon\Forms\Element;
use Ajax\bootstrap\html\base\HtmlSingleElement;
use Ajax\JsUtils;
use Phalcon\Mvc\View;

abstract class PhBsElement extends Element {
	/**
	 * @var HtmlSingleElement
	 */
	protected $htmlElement;
	/**
	 * @var JsUtils
	 */
	protected $js;
	public function __construct($name, array $attributes = null) {
		parent::__construct ( $name, $attributes);
	}

	public function setName($name) {
		$this->htmlElement->setIdentifier($name);
		$this->htmlElement->setProperty("name", $name);
	}


	public function compile(JsUtils $js = NULL,View $view=NULL) {
		return $this->htmlElement->compile($js,$view);
	}

	public function run(JsUtils $js) {
		return $this->htmlElement->run($js);
	}


	/* (non-PHPdoc)
	 * @see \Phalcon\Forms\Element::setAttribute()
	 */
	public function setAttribute($attribute, $value) {
		parent::setAttribute($attribute, $value);
		return $this->htmlElement->setProperty($attribute, $value);
	}


	/**
	 * @return \Ajax\bootstrap\html\base\HtmlSingleElement
	 */
	public function getHtmlElement() {
		return $this->htmlElement;
	}
	public function setHtmlElement(HtmlSingleElement $htmlElement) {
		$this->htmlElement = $htmlElement;
		return $this;
	}



}