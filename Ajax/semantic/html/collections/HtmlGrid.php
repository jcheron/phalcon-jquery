<?php

namespace Ajax\semantic\html\collections;

use Ajax\common\html\HtmlCollection;
use Ajax\semantic\html\content\HtmlGridRow;
use Ajax\semantic\html\base\Wide;
use Ajax\semantic\html\base\TextAlignment;

/**
 * Semantic Grid component
 * @see http://semantic-ui.com/collections/grid.html
 * @author jc
 * @version 1.001
 */
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

	/**
	 * Adds dividers between columns ($vertically=false) or between rows ($vertically=true)
	 * @param boolean $vertically
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setDivided($vertically=false){
		$value=($vertically===true)?"vertically divided":"divided";
		return $this->addToProperty("class", $value);
	}

	/**
	 * Divides rows into cells
	 * @param boolean $internal true for internal cells
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setCelled($internal=false){
		$value=($internal===true)?"internal celled":"celled";
		return $this->addToProperty("class", $value);
	}

	/**
	 * automatically resize all elements to split the available width evenly
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setEqualWidth(){
		return $this->addToProperty("class", "equal width");
	}

	/**
	 * Adds vertical or/and horizontal gutters
	 * @param string $value
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setPadded($value=NULL){
		if(isset($value))
			$this->addToPropertyCtrl("class", $value,array("vertically","horizontally"));
		return $this->addToProperty("class", "padded");
	}

	/**
	 * @param boolean $very
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setRelaxed($very=false){
		$value=($very===true)?"very relaxed":"relaxed";
		return $this->addToProperty("class", $value);
	}

	public function setTextAlignment($value=TextAlignment::LEFT){
		return $this->addToPropertyCtrl("class", $value,TextAlignment::getConstants());
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlCollection::createItem()
	 */
	protected function createItem($value){
		if($this->_createCols===false)
			$value=null;
		$item=new HtmlGridRow($this->identifier."-row-".($this->count()+1),$value,$this->_colSizing);
		return $item;
	}

}