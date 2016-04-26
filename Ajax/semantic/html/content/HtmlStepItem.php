<?php

namespace Ajax\semantic\html\content;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\elements\HtmlIcon;
use Ajax\service\JArray;
use Ajax\semantic\html\base\constants\StepStatus;

class HtmlStepItem extends HtmlSemDoubleElement {

	public function __construct($identifier, $content) {
		parent::__construct($identifier, "div", "step");
		$this->content=array();
		if(\is_array($content)){
			if(JArray::isAssociative($content)===false){
				$icon=JArray::getValue($content, "icon",0);
				$title=JArray::getValue($content, "title",1);
				$desc=JArray::getValue($content, "description",2);
				$status=JArray::getValue($content, "status",3);
			}else{
				$icon=@$content["icon"];
				$title=@$content["title"];
				$desc=@$content["description"];
				$status=@$content["status"];
			}
			if(isset($icon)===true){
				$this->setIcon($icon);
			}
			if(isset($status)===true){
				$this->setStatus($status);
			}
			if(isset($title)===true){
				$this->setTitle($title,$desc);
			}
		}else{
			$this->setContent($content);
		}
	}

	public function setIcon($icon){
		$this->content["icon"]=new HtmlIcon("icon-".$this->identifier, $icon);
	}

	private function createContent(){
		$this->content["content"]=new HtmlSemDoubleElement("content-".$this->identifier,"div","content");
		return $this->content["content"];
	}

	public function setTitle($title,$description=NULL){
		$title=new HtmlSemDoubleElement("","div","title",$title);
		if(\array_key_exists("content", $this->content)===false){
			$this->createContent();
		}
		$this->content["content"]->addContent($title);
		if(isset($description)){
			$description=new HtmlSemDoubleElement("","div","description",$description);
			$this->content["content"]->addContent($description);
		}
		return $this;
	}

	public function setActive(){
		return $this->setStatus(StepStatus::ACTIVE);
	}

	public function setCompleted(){
		return $this->setStatus(StepStatus::COMPLETED);
	}

	public function setStatus($status){
		return $this->addToPropertyCtrl("class", $status, StepStatus::getConstants());
	}

	public function asLink(){
		return $this->setTagName("a");
	}
	public function removeStatus(){
		$this->removePropertyValues("class", StepStatus::getConstants());
	}
}