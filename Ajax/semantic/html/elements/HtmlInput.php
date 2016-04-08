<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\base\constants\State;
use Ajax\semantic\html\base\constants\Direction;

class HtmlInput extends HtmlSemDoubleElement{
	private $_hasIcon=false;

	public function __construct($identifier,$type="text",$value="",$placeholder=""){
		parent::__construct("div-".$identifier,"div","ui input");
		$this->content=new \Ajax\common\html\html5\HtmlInput($identifier,$type,$value,$placeholder);
		$this->_states=[State::DISABLED,State::FOCUS,State::ERROR,State::LOADING];
		$this->_variations=[];
	}

	public function setFocus(){
		$this->addToProperty("class", State::FOCUS);
	}

	public function addIcon($icon,$direction=Direction::LEFT){
		if($this->_hasIcon===false){
			$iconO=$icon;
			if(\is_string($icon)){
				$iconO=new HtmlIcon("icon-".$this->identifier, $icon);
			}
			$this->addToPropertyCtrl("class", $direction." icon", Direction::getConstantValues("icon"));
			$this->addContent($iconO,false);
			$this->_hasIcon=true;
		}else{
			$iconO=$this->getIcon();
			$iconO->setIcon($icon);
			$this->addToPropertyCtrl("class", $direction." icon", Direction::getConstantValues("icon"));
		}
		return $iconO;
	}

	public function getIcon(){
		if(\is_array($this->content)){
			foreach ($this->content as $item){
				if($item instanceof HtmlIcon)
					return $item;
			}
		}
	}

	public function addLoading(){
		if($this->_hasIcon===false){
			throw new \Exception("Input must have an icon for showing a loader, use addIcon before");
		}
		return $this->addToProperty("class", State::LOADING);
	}

	public function addLabel($label,$direction=Direction::LEFT,$icon=NULL){
		$labelO=$label;
		if(\is_object($label)===false){
			$labelO=new HtmlLabel("label-".$this->identifier,$label);
			if(isset($icon))
				$labelO->addIcon($icon);
		}else{
			$labelO->addToPropertyCtrl("class", "label", array("label"));
		}
		$this->addToProperty("class", $direction." labeled");
		$this->addContent($labelO,\strstr($direction,Direction::LEFT)!==false);
		return $labelO;
	}

	public function addLabelToCorner($label,$direction=Direction::LEFT,$icon=NULL){
		return $this->addLabel($label,$direction." corner",$icon)->toCorner($direction);
	}

	public function addAction($action,$direction=Direction::LEFT,$icon=NULL,$labeled=false){
		$actionO=$action;
		if(\is_object($action)===false){
			$actionO=new HtmlButton("action-".$this->identifier,$action);
			if(isset($icon))
				$actionO->addIcon($icon,true,$labeled);
		}
		$this->addToProperty("class", $direction." action");
		$this->addContent($actionO,\strstr($direction,Direction::LEFT)!==false);
		return $actionO;
	}

}