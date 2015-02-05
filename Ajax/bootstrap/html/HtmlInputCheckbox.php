<?php
namespace Ajax\bootstrap\html;
/**
 * Twitter Bootstrap HTML Input checkbox component
 * @author jc
 * @version 1.001
 */
class HtmlInputCheckbox extends HtmlInput{

	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->setProperty("type", "checkbox");
		$this->setProperty("class", "");
	}
}