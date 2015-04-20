<?php

namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\bootstrap\html\base\CssRef;
use Ajax\bootstrap\html\content\HtmlListgroupItem;
use Ajax\bootstrap\html\base\HtmlElementAsContent;

/**
 * Composant Twitter Bootstrap Listgroup
 * @see http://getbootstrap.com/components/#list-group
 * @author jc
 * @version 1.001
 */
class HtmlListgroup extends HtmlDoubleElement {

	public function __construct($identifier, $tagName="ul") {
		parent::__construct($identifier, $tagName);
		$this->content=array ();
		$this->_template='<%tagName% %properties%>%content%</%tagName%>';
		$this->setProperty("class", "list-group");
	}

	public function addItem($text="") {
		if (is_object($text)) {
			$element=$text;
		} else {
			switch($this->tagName) {
				case "ul":
					$element=new HtmlDoubleElement("list-gi-".$this->identifier);
					$element->setTagName("li");
					break;
				default:
					$element=new HtmlLink("list-gi-".$this->identifier);
					break;
			}
			$element->setContent($text);
		}
		
		$item=new HtmlListgroupItem($element);
		if (is_array($text)===true) {
			$item->setHeadingAndContent($text);
		}
		$this->content []=$item;
		return $item;
	}

	public function addItems($items) {
		foreach ( $items as $item ) {
			if (is_string($item)) {
				$this->addItem($item);
			} else
				$this->content []=$item;
		}
	}

	public function getItem($index) {
		if ($index<sizeof($this->content))
			return $this->content [$index];
	}
}