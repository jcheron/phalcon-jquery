<?php
namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\bootstrap\html\base\CssRef;
use Phalcon\Text;
			/**
 * Composant Twitter Bootstrap panel
 * @see http://getbootstrap.com/components/#panels
 * @author jc
 * @version 1.001
 */
 class HtmlPanel extends HtmlDoubleElement {
 	protected $header;
 	protected $footer;
 	protected $class;
	public function __construct($identifier) {
		parent::__construct ( $identifier, "div");
		$this->_template=include 'templates/tplPanel.php';
		$this->class="panel panel-default";
	}
	public function getHeader() {
		return $this->header;
	}

	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}

	public function getFooter() {
		return $this->footer;
	}

	public function setFooter($footer) {
		$this->footer = $footer;
		return $this;
	}

	public function addHeader($content){
		$header=new HtmlDoubleElement("header-".$this->identifier);
		$header->setTagName("div");
		$header->setClass("panel-heading");
		$header->setContent($content);
		$this->header=$header;
		return $this;
	}

	public function addHeaderH($content,$niveau="1"){
		return $this->addHeader("<h".$niveau." class='panel-title'>".$content."</h".$niveau.">");
	}

	public function addFooter($content){
		$footer=new HtmlDoubleElement("footer-".$this->identifier);
		$footer->setTagName("div");
		$footer->setClass("panel-footer");
		$footer->setContent($content);
		$this->footer=$footer;
		return $this;
	}

	/**
	 * define the Panel style
	 * avaible values : "panel-default","panel-primary","panel-success","panel-info","panel-warning","panel-danger"
	 * @param string/int $cssStyle
	 * @return \Ajax\bootstrap\html\HtmlPanel
	 * default : "panel-default"
	 */
	public function setStyle($cssStyle){
		if(!Text::startsWith($cssStyle, "panel"))
			$cssStyle="panel".$cssStyle;
		return $this->addToMemberCtrl($this->class,$cssStyle,CssRef::Styles("panel"));
	}
}