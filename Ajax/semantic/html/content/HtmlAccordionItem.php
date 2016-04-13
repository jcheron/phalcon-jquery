<?php

namespace Ajax\semantic\html\content;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\elements\HtmlIcon;
use Ajax\JsUtils;
use Phalcon\Mvc\View;


class HtmlAccordionItem extends HtmlSemDoubleElement {
	protected $titleElement;
	protected $_icon="dropdown";
	protected $_title;

	public function __construct($identifier, $title, $content=NULL) {
		parent::__construct($identifier, "div", "content", $content);
		$this->_template="%titleElement%".$this->_template;
		$this->_title=$title;
	}

	public function setTitle($title){
		$this->_title=$title;
	}

	public function setIcon($icon){
		$this->_icon=$icon;
	}

	protected function createTitleElement(){
		$element=new HtmlSemDoubleElement("title-".$this->identifier,"div","title");
		$element->setContent(array(new HtmlIcon("", $this->_icon),$this->_title));
		return $element;
	}

	public function compile(JsUtils $js=NULL, View $view=NULL){
		$this->titleElement=$this->createTitleElement();
		return parent::compile($js,$view);
	}
}