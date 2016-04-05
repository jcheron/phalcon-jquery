<?php

namespace Ajax\semantic\html\elements;

use Ajax\common\html\html5\HtmlCollection;
use Ajax\semantic\html\base\SegmentType;

class HtmlSegmentGroups extends HtmlCollection{


	public function __construct( $identifier, $items=array()){
		parent::__construct( $identifier, "div");
		$this->setClass("ui segments");
		$this->addItems($items);
	}


	protected function createItem($value){
		return new HtmlSegment("segment-".$this->count(),$value);
	}

	/**
	 * Defines the group type
	 * @param string $type one of "raised","stacked","piled" default : ""
	 * @return \Ajax\semantic\html\elements\HtmlSegmentGroups
	 */
	public function setType($type){
		return $this->addToPropertyCtrl("class", $type, SegmentType::getConstants());
	}

	public function setSens($sens="vertical"){
		return $this->addToPropertyCtrl("class", $sens, array("vertical","horizontal"));
	}


	public static function group($identifier,$items=array(),$type="",$sens="vertical"){
		$group=new HtmlSegmentGroups($identifier,$items);
		$group->setSens($sens);
		return $group->setType($type);
	}

}