<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\JsUtils;
use Ajax\common\html\BaseHtml;


class HtmlPopup extends HtmlSemDoubleElement {
	private $params;
	private $_container;
	public function __construct(BaseHtml $container,$identifier, $content="") {
		parent::__construct($identifier, "div");
		$this->_container=$container;
		$this->setClass("ui popup");
		$this->content=$content;
		$this->params=array("on"=>"click");
	}

	public function setFlowing(){
		return $this->addToProperty("class", "flowing");
	}

	public function setBasic(){
		return $this->addToProperty("class", "basic");
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\semantic\html\base\HtmlSemDoubleElement::run()
	 */
	public function run(JsUtils $js){
		$this->params["popup"]="#".$this->identifier;
		$js->semantic()->popup("#".$this->_container->getIdentifier(),$this->params);
	}
}