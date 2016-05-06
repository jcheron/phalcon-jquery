<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\constants\State;
use Ajax\semantic\html\base\constants\Direction;
use Ajax\semantic\html\base\constants\Variation;
use Ajax\semantic\html\base\traits\IconTrait;

class HtmlInput extends HtmlSemDoubleElement {
	use IconTrait;

	public function __construct($identifier, $type="text", $value="", $placeholder="") {
		parent::__construct("div-" . $identifier, "div", "ui input");
		$this->content=[ "field" => new \Ajax\common\html\html5\HtmlInput($identifier, $type, $value, $placeholder) ];
		$this->_states=[ State::DISABLED,State::FOCUS,State::ERROR ];
		$this->_variations=[ Variation::TRANSPARENT ];
	}

	public function setFocus() {
		$this->addToProperty("class", State::FOCUS);
	}

	public function addLoading() {
		if ($this->_hasIcon === false) {
			throw new \Exception("Input must have an icon for showing a loader, use addIcon before");
		}
		return $this->addToProperty("class", State::LOADING);
	}

	public function labeled($label, $direction=Direction::LEFT, $icon=NULL) {
		$labelO=$label;
		if (\is_object($label) === false) {
			$labelO=new HtmlLabel("label-" . $this->identifier, $label);
			if (isset($icon))
				$labelO->addIcon($icon);
		} else {
			$labelO->addToPropertyCtrl("class", "label", array ("label" ));
		}
		$this->addToProperty("class", $direction . " labeled");
		$this->addContent($labelO, \strstr($direction, Direction::LEFT) !== false);
		return $labelO;
	}

	public function labeledToCorner($label, $direction=Direction::LEFT, $icon=NULL) {
		return $this->labeled($label, $direction . " corner", $icon)->toCorner($direction);
	}

	public function addAction($action, $direction=Direction::LEFT, $icon=NULL, $labeled=false) {
		$actionO=$action;
		if (\is_object($action) === false) {
			$actionO=new HtmlButton("action-" . $this->identifier, $action);
			if (isset($icon))
				$actionO->addIcon($icon, true, $labeled);
		}
		$this->addToProperty("class", $direction . " action");
		$this->addContent($actionO, \strstr($direction, Direction::LEFT) !== false);
		return $actionO;
	}

	public function getField() {
		return $this->content["field"];
	}

	public function setPlaceholder($value) {
		$this->getField()->setPlaceholder($value);
		return $this;
	}
}