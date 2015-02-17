<?php
namespace Ajax\bootstrap\html;
use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\JsUtils;
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

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->generic("#".$this->identifier);
		$this->addEventsOnRun();
		return $this->_bsComponent;
	}

	public function onClick($jsCode){
		return $this->addEvent("click", $jsCode);
	}

	public function setTarget($value="_self"){
		return $this->setProperty("target", $value);
	}
	//TODO use Class Tag
}