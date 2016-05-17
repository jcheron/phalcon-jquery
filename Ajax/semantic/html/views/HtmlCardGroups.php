<?php

namespace Ajax\semantic\html\views;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\service\JArray;

class HtmlCardGroups extends HtmlSemCollection {

	public function __construct($identifier, $cards=array()) {
		parent::__construct($identifier, "div", "ui cards");
		$this->addItems($cards);
	}

	protected function createItem($value) {
		$result=new HtmlCard("card-" . $this->count());
		if (\is_array($value)) {
			$header=JArray::getValue($value, "header", 0);
			$metas=JArray::getValue($value, "metas", 1);
			$description=JArray::getValue($value, "description", 2);
			$result->addCardHeaderContent($header, $metas, $description);
		} else
			$result->addCardContent($value);
		return $result;
	}

	public function getCard($index) {
		return $this->getItem($index);
	}
}