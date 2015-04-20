<?php

namespace Ajax\bootstrap\html\base;

use Ajax\JsUtils;

class HtmlElementAsContent extends BaseHtml {
	protected $element;

	public function __construct($element) {
		if ($element instanceof HtmlSingleElement) {
			$this->element=$element;
		} elseif (is_string($element)) {
			$this->element=new HtmlDoubleElement($element);
		}
		$this->identifier=$element->getIdentifier();
	}

	public function getElement() {
		return $this->element;
	}

	public function setElement($element) {
		$this->element=$element;
		return $this;
	}

	public function run(JsUtils $js) {
		$this->element->run($js);
	}
}