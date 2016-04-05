<?php

namespace Ajax\semantic\html\collections;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
/**
 * Semantic Message component
 * @see http://semantic-ui.com/collections/message.html
 * @author jc
 * @version 1.001
 */
class HtmlMessage extends HtmlSemDoubleElement {

	public function __construct($identifier, $content="") {
		parent::__construct($identifier, "div");
		$this->setClass("ui message");
		$this->setContent($content);
	}
}