<?php
namespace Ajax\bootstrap\html;
/**
 * Twitter Bootstrap HTML Button toolbar
 * @author jc
 * @version 1.001
 */
use Ajax\bootstrap\html\HtmlButtongroups;
class HtmlButtontoolbar extends HtmlButtongroups {
	public function __construct($identifier, $elements=array(),$cssStyle=NULL,$size=NULL,$tagName = "div") {
		parent::__construct ( $identifier,$elements,$cssStyle,$size, $tagName);
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

	/**
	 * Add and return a new buttongroup
	 * @return \Ajax\bootstrap\html\HtmlButtongroups
	 */
	public function addGroup(){
		$bg=null;
		$nb=sizeof($this->elements);
		$bg=new HtmlButtongroups($this->identifier."-buttongroups-".$nb);
		$this->elements[]=$bg;
		return $bg;
	}

	private function getLastButtonGroup(){
		$bg=null;
		$nb=sizeof($this->elements);
		if($nb>0)
			$bg=$this->elements[$nb-1];
		else{
			$bg=new HtmlButtongroups($this->identifier."-buttongroups-".$nb);
			$this->elements[]=$bg;
		}
		return $bg;
	}

	/**
	 * return the Buttongroups at position $index
	 * @return \Ajax\bootstrap\html\HtmlButtongroups
	 */
	public function getElement($index) {
		return parent::getElement($index);
	}


}