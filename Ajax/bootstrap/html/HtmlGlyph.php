<?php
class HtmlGlyphicon extends \HtmlSingleElement {
	protected $glyphicon;
	public function __construct($identifier) {
		parent::__construct($identifier,"span");
		$this->_template='<span class="glyphicon %glyphicon%" aria-hidden="true"></span>';
	}

	public static getGlyphicon($index){
		$result=new HtmlGlyphicon("");
		//TODO Out of bounds
		$result->setGlyphicon(CssRef::glyphIcons()[$index]);
		return $result;
	}

	public function setGlyphicon($glyphicon){
		$this->glyphicon=$glyphicon;
	}
}