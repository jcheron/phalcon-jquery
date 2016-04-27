<?php
namespace Ajax\semantic\traits;

use Ajax\semantic\html\collections\form\HtmlFormCheckbox;
use Ajax\semantic\html\base\constants\CheckboxType;
use Ajax\semantic\html\collections\HtmlTable;


trait SemanticHtmlCollectionsTrait {

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
	public function htmlTable($identifier, $rowCount, $colCount){
		return $this->addHtmlComponent(new HtmlTable($identifier, $rowCount, $colCount));
	}
}