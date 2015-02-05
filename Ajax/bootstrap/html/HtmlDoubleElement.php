<?php
namespace Ajax\bootstrap\html;

use Ajax\JsUtils;
include_once 'HtmlSingleElement.php';

class HtmlDoubleElement extends HtmlSingleElement {
	protected $content;
	public function __construct($identifier,$tagName="p") {
		parent::__construct($identifier,$tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%content%</%tagName%>";
	}

	public function setContent($content){
		$this->content=$content;
	}
	public function getContent() {
		return $this->content;
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		if($this->content instanceof HtmlDoubleElement)
			$this->content->run($js);

	}

}