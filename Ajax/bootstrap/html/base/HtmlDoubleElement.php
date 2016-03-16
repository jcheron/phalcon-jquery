<?php

namespace Ajax\bootstrap\html\base;

use Ajax\JsUtils;
use Ajax\bootstrap\html\HtmlBadge;
use Ajax\bootstrap\html\HtmlLabel;
use Ajax\bootstrap\html\HtmlGlyphicon;

class HtmlDoubleElement extends HtmlSingleElement {
	/**
	 *
	 * @var mixed
	 */
	protected $content;
	protected $wrapContentBefore="";
	protected $wrapContentAfter="";

	public function __construct($identifier, $tagName="p") {
		parent::__construct($identifier, $tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%wrapContentBefore%%content%%wrapContentAfter%</%tagName%>";
	}

	public function setContent($content) {
		$this->content=$content;
		return $this;
	}

	public function getContent() {
		return $this->content;
	}

	public function addContent($content) {
		if (is_array($this->content)===false) {
			$newContent=array ();
			if (isset($this->content))
				$newContent []=$this->content;
			$newContent []=$content;
			$this->content=$newContent;
		} else {
			$this->content []=$content;
		}
		return $this;
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		parent::run($js);
		if ($this->content instanceof HtmlDoubleElement) {
			$this->content->run($js);
		} else if (is_array($this->content)) {
			foreach ( $this->content as $itemContent ) {
				if ($itemContent instanceof HtmlDoubleElement) {
					$itemContent->run($js);
				}
			}
		}
	}

	public function addBadge($caption, $leftSeparator="&nbsp;") {
		$badge=new HtmlBadge("badge-".$this->identifier, $caption);
		$badge->wrap($leftSeparator);
		$this->addContent($badge);
		return $this;
	}

	public function addLabel($caption, $style="label-default", $leftSeparator="&nbsp;") {
		$label=new HtmlLabel("label-".$this->identifier, $caption, $style);
		$label->wrap($leftSeparator);
		$this->addContent($label);
		return $this;
	}

	public function addGlyph($glyphicon,$index=0){
		$glyph=new HtmlGlyphicon("");
		$glyph->setGlyphicon($glyphicon);
		$this->addContent($glyph);
		return $this;
	}

	public function setValue($value) {
	}

	public function wrapContent($before, $after="") {
		$this->wrapContentBefore.=$before;
		$this->wrapContentAfter=$after.$this->wrapContentAfter;
		return $this;
	}

	public function wrapContentWithGlyph($glyphBefore,$glyphAfter=""){
		$before=HtmlGlyphicon::getGlyphicon($glyphBefore)."&nbsp;";
		$after="";
		if($glyphAfter!==""){
			$after="&nbsp;".HtmlGlyphicon::getGlyphicon($glyphAfter);
		}
		return $this->wrapContent($before,$after);
	}
}