<?php

namespace Ajax\semantic\html\collections;

use Ajax\common\html\html5\HtmlCollection;
use Ajax\semantic\html\content\HtmlGridRow;
use Ajax\semantic\html\base\Wide;

class HtmlGrid extends HtmlCollection{

	private $_createCols;
	private $_colSizing=true;
	public function __construct( $identifier,$numRows=1,$numCols=NULL,$createCols=true){
		parent::__construct( $identifier, "div");
		$this->_createCols=$createCols;
		if(isset($numCols)){
			if($this->_createCols){
				$this->_colSizing=false;
			}
			$cols=Wide::getConstants()["W".$numCols];
			$this->setClass($cols." column");
		}
		$this->addToProperty("class","ui grid");
		$this->setNumRows($numRows,$numCols);
	}

	/**
	 * Create $numRows rows
	 * @param int $numRows
	 * @param int $numCols
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setNumRows($numRows,$numCols=NULL){
		$count=$this->count();
		for($i=$count;$i<$numRows;$i++){
			$this->addItem($numCols);
		}
		return $this;
	}

	/**
	 * return the row at $index
	 * @param int $index
	 * @return \Ajax\semantic\html\collections\HtmlGridRow
	 */
	public function getRow($index){
		return $this->getItem($index);
	}

	/**
	 * @param int $row
	 * @param int $col
	 * @return \Ajax\semantic\html\collections\HtmlGridCol
	 */
	public function getCell($row,$col){
		$row=$this->getItem($row);
		if(isset($row)){
			$col=$row->getItem($col);
		}
		return $col;
	}

	protected function createItem($value){
		if($this->_createCols===false)
			$value=null;
		$item=new HtmlGridRow($this->identifier."-row-".($this->count()+1),$value,$this->_colSizing);
		return $item;
	}

}