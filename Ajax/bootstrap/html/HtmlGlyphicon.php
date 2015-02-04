<?php
namespace Ajax\bootstrap\html;

/**
 * Composant Twitter Bootstrap Glyphicon
 * @author jc
 * @version 1.001
 */
class HtmlGlyphicon extends HtmlSingleElement {
	protected $glyphicon;
	public function __construct($identifier) {
		parent::__construct($identifier,"span");
		$this->_template='<span class="glyphicon %glyphicon%" aria-hidden="true"></span>';
	}

	/**
	 * Defines the glyphicon with his name or his index
	 * @param string/int $glyphicon
	 * @return \Ajax\bootstrap\html\HtmlGlyphicon
	 */
	public function setGlyphicon($glyphicon){
		if(is_int($glyphicon))
			$glyphicon=CssRef::glyphIcons()[$glyphicon];
		return $this->setMemberCtrl("glyphicon", $glyphicon, CssRef::glyphIcons());
	}

	/**
	 * return an instance of GlyphButton with a glyph defined by string or index
	 * @param string/int $index
	 * @return \Ajax\bootstrap\html\HtmlGlyphicon
	 */
	public static function getGlyphicon($glyph){
		$result=new HtmlGlyphicon("");
		$result->setGlyphicon($glyph);
		return $result;
	}
}