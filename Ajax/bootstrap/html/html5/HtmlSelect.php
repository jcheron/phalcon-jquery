<?php

namespace Ajax\bootstrap\html\html5;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\JsUtils;

class HtmlSelect extends HtmlDoubleElement {

	public function __construct($identifier) {
		parent::__construct($identifier, "select");
	}

	public function setOptions($options) {
		foreach ( $options as $key => $value ) {
			$this->_addOption($key, $value);
		}
	}

	private function _addOption($key, $value) {
		$elm=new HtmlDoubleElement("opt-".$key);
		$elm->setTagName("option");
		$elm->setProperty("value", $key);
		$elm->setContent($value);
		$this->addContent($elm);
	}

	public function addOption($option) {
		if (is_array($option)) {
			if (sizeof($option)>1) {
				$this->_addOption($option [0], $option [1]);
			}
		} else {
			$this->_addOption(sizeof($this->content), $option);
		}
	}

	public function setValue($value) {
		foreach ( $this->content as $option ) {
			if ($option->getProperty("value")===$value) {
				$option->setProperty("selected", "");
				break;
			}
		}
	}

	public function setLabel($label, $before=true) {
		if ($before===true) {
			$this->wrap("<label for='".$this->identifier."'>".$label."</label>", "");
		} else {
			$this->wrap("", "<label for='".$this->identifier."'>&nbsp;".$label."</label>");
		}
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		parent::run($js);
		$this->_bsComponent=$js->bootstrap()->generic("#".$this->identifier);
		$this->addEventsOnRun($js);
		return $this->_bsComponent;
	}

	public function onChange($jsCode) {
		return $this->addEvent("change", $jsCode);
	}

	public function onKeypress($jsCode) {
		return $this->addEvent("keypress", $jsCode);
	}
}