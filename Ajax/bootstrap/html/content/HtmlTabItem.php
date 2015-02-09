<?php
namespace Ajax\bootstrap\html\content;
use Ajax\JsUtils;
use Ajax\bootstrap\html\HtmlLink;
use Ajax\bootstrap\Components\Tab;
use Ajax\bootstrap\html\base\HtmlDoubleElement;

/**
 * Inner element for Twitter Bootstrap HTML Dropdown component
 * @author jc
 * @version 1.001
 */
class HtmlTabItem extends HtmlDoubleElement {
	public function __construct($identifier, $caption="",$href="#") {
		parent::__construct ( $identifier, "li" );
		$this->_template='<%tagName% id="%identifier%">%content%</%tagName%>';
		$this->content=new HtmlLink("link-".$identifier);
		$this->content->setHref($href);
		$this->content->setContent($caption);
		$this->setProperty("role", "presentation");
	}


	public function setHref($value){
		$this->content->setHref($value);
	}

	public function setContent($value){
		$this->content->setContent($value);
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlDoubleElement::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->tab("#".$this->identifier);
		$this->addEventsOnRun();
		return $this->_bsComponent;
	}

	public function getHref(){
		return $this->content->getHref();
	}


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::fromArray()
	 */
	public function fromArray($array) {
		if(array_key_exists("href", $array)){
			$this->setHref($array["href"]);
			unset($array["key"]);
		}
		return parent::fromArray($array);
	}


}