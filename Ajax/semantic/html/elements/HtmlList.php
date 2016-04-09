<?php

namespace Ajax\semantic\html\elements;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\content\HtmlListItem;

class HtmlList extends HtmlSemCollection{


	public function __construct( $identifier, $items=array()){
		parent::__construct( $identifier, "div", "ui list");
		$this->addItems($items);
	}


	protected function createItem($value){
		$count=$this->count();
		if(\is_array($value)){
			$item=new HtmlListItem("item-".$this->identifier."-".$count, $value[0]);
			$item->addIcon($value[1]);
		}else
			$item= new HtmlListItem("item-".$this->identifier."-".$count, $value);
		return $item;
	}

}