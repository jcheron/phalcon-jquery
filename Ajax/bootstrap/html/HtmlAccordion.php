<?php
namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\JsUtils;
		/**
 * Composant Twitter Bootstrap Listgroup
 * @see http://getbootstrap.com/javascript/#collapse-example-accordion
 * @author jc
 * @version 1.001
 */
class HtmlAccordion extends HtmlDoubleElement {

	public function __construct($identifier, $tagName = "div") {
		parent::__construct ( $identifier,$tagName);
		$this->setClass("panel-group");
		$this->setRole("tablist");
		$this->setProperty("aria-multiselectable", "true");
		$this->content=array();
	}

	public function addPanel($title,$content){
		$nb=sizeof($this->content)+1;
		$panel=new HtmlPanel("panel-".$this->identifier."-".$nb);
		$link=new HtmlLink("lnk-panel-".$this->identifier."-".$nb);
		$link->setProperty("data-toggle", "collapse");
		$link->setProperty("data-parent", "#".$this->identifier);
		$link->setHref("#collapse-panel-".$this->identifier."-".$nb);
		$link->setContent($title);
		$panel->addHeader($link);
		$panel->setContent($content);
		$panel->setCollapsable(true);
		$this->content[]=$panel;
		return $panel;
	}


	public function run(JsUtils $js) {
		foreach ($this->content as $content){
			$content->run($js);
		}
	}

	public function getPanel($index){
		if($index<sizeof($this->content))
			return $this->content[$index];
	}


}