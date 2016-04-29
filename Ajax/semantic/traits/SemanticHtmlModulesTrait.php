<?php
namespace Ajax\semantic\traits;

use Ajax\semantic\html\collections\form\HtmlFormCheckbox;
use Ajax\semantic\html\base\constants\CheckboxType;
use Ajax\semantic\html\modules\HtmlRating;


trait SemanticHtmlModulesTrait {

	public abstract function addHtmlComponent($htmlComponent);

	/**
	 * Module checkbox
	 * @param string $identifier
	 * @param string $label
	 * @param mixed $value
	 * @param CheckboxType $type
	 */
	public function htmlCheckbox($identifier, $label=NULL,$value=NULL,$type=NULL){
		return $this->addHtmlComponent(new HtmlFormCheckbox($identifier,$label,$value,$type));
	}

	/**
	 * @param string $identifier
	 * @param int $rowCount
	 * @param int $colCount
	 */
	public function htmlRating($identifier, $value, $max,$icon=""){
		return $this->addHtmlComponent(new HtmlRating($identifier, $value, $max,$icon));
	}
}