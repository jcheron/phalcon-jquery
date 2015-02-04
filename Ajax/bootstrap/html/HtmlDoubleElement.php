<?php
include_once 'HtmlSingleElement.php';

class HtmlDoubleElement extends \HtmlSingleElement {
	protected $content;
	public function __construct($identifier,$tagName="p") {
		parent::__construct($identifier,$tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%content%</%tagName%>";
	}

	public function setContent($content){
		$this->content=$content;
	}
}