<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\Size;
use Ajax\common\html\HtmlDoubleElement;

class HtmlHeader extends HtmlSemDoubleElement {

	public function __construct($identifier, $niveau=1,$content=NULL,$type="page") {
		parent::__construct($identifier, "div");
		$this->setClass("ui header");
		if(isset($type)){
			if($type=="page"){
				$this->asPageHeader($niveau);
			}else
				$this->asContentHeader($niveau);
		}
		$this->content=$content;
	}

	public function asPageHeader($niveau){
		$this->tagName="h".$niveau;
	}

	public function asContentHeader($niveau){
		$this->tagName="div";
		if(\is_int($niveau)){
			$niveau=Size::getConstantValues()[$niveau];
		}
		$this->setSize($niveau);
	}

	public function asIcon($icon,$content,$subHeader=NULL){
		$this->addToProperty("class", "icon");
		$icon=new HtmlIcon("icon-".$this->identifier, $icon);
		$contentElm=new HtmlDoubleElement("content-".$this->identifier,"div");
		$contentElm->setClass("content")->setContent($content);
		if(isset($subHeader)){
			$sub=new HtmlDoubleElement("subheader-".$this->identifier,"div");
			$sub->setClass("sub header");
			$sub->setContent($subHeader);
			$contentElm->addContent($sub);
		}
		$this->content=array($icon,$contentElm);
	}
}