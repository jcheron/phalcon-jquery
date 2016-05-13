<?php

namespace Ajax\semantic\traits;

use Ajax\semantic\html\collections\form\HtmlFormCheckbox;
use Ajax\semantic\html\base\constants\CheckboxType;
use Ajax\semantic\html\modules\HtmlRating;
use Ajax\semantic\html\modules\HtmlProgress;
use Ajax\semantic\html\modules\HtmlSearch;
use Ajax\semantic\html\modules\HtmlDimmer;

trait SemanticHtmlModulesTrait {

	public abstract function addHtmlComponent($htmlComponent);

	/**
	 * Module checkbox
	 * @param string $identifier
	 * @param string $label
	 * @param mixed $value
	 * @param CheckboxType $type
	 */
	public function htmlCheckbox($identifier, $label=NULL, $value=NULL, $type=NULL) {
		return $this->addHtmlComponent(new HtmlFormCheckbox($identifier, $label, $value, $type));
	}

	/**
	 *
	 * @param string $identifier
	 * @param int $rowCount
	 * @param int $colCount
	 */
	public function htmlRating($identifier, $value, $max, $icon="") {
		return $this->addHtmlComponent(new HtmlRating($identifier, $value, $max, $icon));
	}

	/**
	 *
	 * @param string $identifier
	 * @param int $value
	 * @param string $label
	 */
	public function htmlProgress($identifier, $value=0, $label=NULL) {
		return $this->addHtmlComponent(new HtmlProgress($identifier, $value, $label));
	}

	/**
	 *
	 * @param string $identifier
	 * @param string $placeholder
	 */
	public function htmlSearch($identifier, $placeholder=NULL, $icon=NULL) {
		return $this->addHtmlComponent(new HtmlSearch($identifier, $placeholder, $icon));
	}

	/**
	 *
	 * @param string $identifier
	 * @param mixed $content
	 */
	public function htmlDimmer($identifier, $content=NULL) {
		return $this->addHtmlComponent(new HtmlDimmer($identifier, $content));
	}
}