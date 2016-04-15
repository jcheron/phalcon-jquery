<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\base\constants\Wide;
use Ajax\JsUtils;
use Phalcon\Mvc\View;

class HtmlFormFields extends HtmlSemCollection {

	use FieldsTrait;
	protected $_equalWidth;

	public function __construct($identifier, $fields=array(),$equalWidth=true) {
		parent::__construct($identifier, "div");
		$this->_equalWidth=$equalWidth;
		$this->addItems($fields);
	}

	public function compile(JsUtils $js=NULL,View $view=NULL){
		if($this->_equalWidth){
			$count=$this->count();
			$this->setClass( Wide::getConstants()["W".$count]." fields");
		}else
			$this->setClass("fields");
		return parent::compile($js,$view);
	}

	public function setWidth($index,$width){
		$this->_equalWidth=false;
		return $this->getItem($index)->setWidth($width);
	}
}