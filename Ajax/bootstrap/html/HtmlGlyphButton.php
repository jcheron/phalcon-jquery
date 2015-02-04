<?php
namespace Ajax\bootstrap\html;
/**
 * Twitter Bootstrap Button component with a Glyph icon
 * @author jc
 * @version 1.001
 */
require_once 'HtmlButton.php';
class HtmlGlyphButton extends HtmlButton {
	protected $glyph;

	public function __construct($identifier,$glyph=0) {
		parent::__construct($identifier);
		$this->_template="<%tagName% id='%identifier%' %properties%>%glyph% %content%</%tagName%>";
		$this->tagName="button";
		$this->setGlyph($glyph);
	}
	public function setGlyph($glyph) {
		if(is_int($glyph))
			$this->glyph=HtmlGlyphicon::getGlyphicon($glyph);
		else{
			$this->glyph = new HtmlGlyphicon();
			$this->glyph->setGlyphicon($glyph);
		}
		return $this;
	}
}