<?php
namespace Ajax\bootstrap\html;
/**
 * Twitter Bootstrap HTML Button toolbar
 * @author jc
 * @version 1.001
 */
use Ajax\bootstrap\html\HtmlButtongroups;
class HtmlButtontoolbar extends HtmlButtongroups {
	public function __construct($identifier, $tagName = "div") {
		parent::__construct ( $identifier, $tagName = "div" );
		$this->setClass("btn-toolbar");
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlButtongroups::addElement()
	 */
	public function addElement($element) {
		if($element instanceof HtmlButtongroups){
			$this->elements[]=$element;
		}else{
			$this->getLastButtonGroup()->addElement($element);
		}
	}
	private function getLastButtonGroup(){
		$bg=null;
		$nb=sizeof($this->elements);
		if($nb>1)
			$bg=$this->elements[$nb-1];
		else{
			$bg=new HtmlButtongroups($this->identifier."-buttongroups-".$nb);
			$this->elements[]=$bg;
		}
		return $bg;
	}

}