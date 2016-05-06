<?php

namespace Ajax\semantic\html\modules;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\elements\HtmlInput;
use Ajax\JsUtils;
use Ajax\semantic\html\base\constants\Direction;

class HtmlSearch extends HtmlSemDoubleElement {
	private $_elements=array ();
	private $_params=array ();
	private $_searchFields=array ("title" );

	public function __construct($identifier, $placeholder=NULL, $icon=NULL) {
		parent::__construct("search-" . $identifier, "div", "ui search", array ());
		$this->createField($placeholder, $icon);
		$this->createResult();
		$this->_params["type"]="standard";
	}

	private function createField($placeholder=NULL, $icon=NULL) {
		$field=new HtmlInput($this->identifier);
		if (isset($placeholder) === true)
			$field->setPlaceholder($placeholder);
		if (isset($icon) === true)
			$field->addIcon($icon, Direction::RIGHT);
		$field->getField()->setClass("prompt");
		$this->content["field"]=$field;
		return $field;
	}

	private function createResult() {
		$this->content["result"]=new HtmlSemDoubleElement("results-" . $this->identifier, "div", "results");
		return $this->content["result"];
	}

	public function addResult($object) {
		$this->_elements[]=$object;
		return $this;
	}

	public function addResults($objects) {
		$this->_elements=\array_merge($this->_elements, $objects);
		return $this;
	}

	public function setUrl($url) {
		$this->_params["apiSettings"]="%{url: %quote%" . $url . "%quote%}%";
		return $this;
	}

	public function setType($type) {
		$this->_params["type"]=$type;
		return $this;
	}

	public function getType() {
		return $this->_params["type"];
	}

	private function resultsToJson() {
		$result=\json_encode($this->_elements);
		return $result;
	}

	public function run(JsUtils $js) {
		$searchFields=\json_encode($this->_searchFields);
		$searchFields=str_ireplace("\"", "%quote%", $searchFields);
		$this->_params["searchFields"]="%" . $searchFields . "%";
		if ($this->getType() === "standard")
			$this->_params["source"]="%content%";
		$this->addEvent("beforeExecute", "var content=" . $this->resultsToJson() . ";");
		if (isset($this->_bsComponent) === false) {
			$this->_bsComponent=$js->semantic()->search("#" . $this->identifier, $this->_params);
		}
		$this->addEventsOnRun($js);
		return $this->_bsComponent;
	}
}