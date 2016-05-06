<?php

namespace Ajax\semantic\components\search;

use Ajax\service\JArray;

class SearchResults {
	private $elements;

	public function __construct($objects=NULL) {
		$this->elements=array ();
		if (isset($objects)) {
			if (\is_array($objects)) {
				$this->addResults($objects);
			} else {
				$this->addResult($objects);
			}
		}
	}

	public function addResult($object) {
		$this->elements[]=$object;
		return $this;
	}

	public function addResults($objects) {
		if (JArray::dimension($objects) === 1) {
			foreach ( $objects as $object ) {
				$this->addResult([ "title" => $object ]);
			}
		} else
			$this->elements=\array_merge($this->elements, $objects);
		return $this;
	}

	public function search($query, $field="title") {
		$result=array ();
		foreach ( $this->elements as $element ) {
			if (\array_key_exists($field, $element)) {
				$value=$element[$field];
				if (\stripos($value, $query) !== false) {
					$result[]=$element;
				}
			}
		}
		if (\sizeof($result) > 0) {
			return $result;
		}
		return false;
	}

	public function __toString() {
		$result="\"results\": " . \json_encode($this->elements);
		return $result;
	}

	public function count() {
		return \sizeof($this->elements);
	}

	public function getStandard() {
		return "{" . $this . "}";
	}
}