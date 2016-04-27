<?php

namespace Ajax\semantic\html\content\table;

use Ajax\semantic\html\base\HtmlSemCollection;

class HtmlTR extends HtmlSemCollection{

	private $_tdTagName;
	private $_container;
	private $_row;

	public function __construct( $identifier, $colCount){
		parent::__construct( $identifier, "tr", "");
	}

	public function setColCount($colCount){
		$count=$this->count();
		for($i=$count;$i<$colCount;$i++){
			$item=$this->addItem(NULL);
			$item->setTagName($this->_tdTagName);
		}
		return $this;
	}


	protected function createItem($value){
		$count=$this->count();
		$td=new HtmlTD("",$this->_container,$value,$this->_tdTagName);
		$td->setContainer($this->_container, $this->_row, $count);
		return $td;
	}

	public function setTdTagName($tagName="td"){
		$this->_tdTagName=$tagName;
	}

	public function setContainer($container,$row){
		$this->_container=$container;
		$this->_row=$row;
	}

	public function setValues($values=array()){
		$count=$this->count();
		if(\is_array($values)===false){
			$values=\array_fill(0, $count, $values);
		}
		$count=\min(\sizeof($values),$count);

		for ($i=0;$i<$count;$i++){
			$cell=$this->content[$i];
			$cell->setValue($values[$i]);
		}
	}

	public function delete($index){
		$this->removeItem($index);
		return $this;
	}
}