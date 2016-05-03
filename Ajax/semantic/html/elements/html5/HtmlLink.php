<?php

namespace Ajax\semantic\html\elements\html5;

use Ajax\JsUtils;
use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\common\html\html5\HtmlLinkTrait;

class HtmlLink extends HtmlSemDoubleElement {
	use HtmlLinkTrait;

	public function __construct($identifier, $href="#", $content="Link") {
		parent::__construct($identifier, "a", "");
		$this->setHref($href);
		$this->content=$content;
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->semantic()->generic("#" . $this->identifier);
		$this->addEventsOnRun($js);
		return $this->_bsComponent;
	}
	// TODO use Class Tag
}