<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\Size;
use Ajax\common\html\HtmlDoubleElement;

class HtmlHeader extends HtmlSemDoubleElement {
	protected $image;
	public function __construct($identifier, $niveau=1,$content=NULL,$type="page") {
		parent::__construct($identifier, "div");
		$this->_template="<%tagName% %properties%>%image%%content%</%tagName%>";
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

	public function asIcon($icon,$title,$subHeader=NULL){
		$this->addToProperty("class", "icon");
		$this->image=new HtmlIcon("icon-".$this->identifier, $icon);
		return $this->asTitle($title,$subHeader);
	}

	public function asImage($src,$title,$subHeader=NULL){
		$this->image=new HtmlImage("img-".$this->identifier, $src,$title);
		return $this->asTitle($title,$subHeader);
	}

	public function asTitle($title,$subHeader=NULL){
		if(!\is_object($title)){
			$this->content=new HtmlDoubleElement("content-".$this->identifier,"div");
			$this->content->setContent($title);
		}else{
			$this->content=$title;
		}
		$this->content->setClass("content");
		if(isset($subHeader)){
			$sub=new HtmlDoubleElement("subheader-".$this->identifier,"div");
			$sub->setClass("sub header");
			$sub->setContent($subHeader);
			$this->content->addContent($sub);
		}
		return $this;
	}

	public function getImage() {
		return $this->image;
	}

}