<?php

namespace Ajax\semantic\html\collections;

use Ajax\common\html\HtmlCollection;
use Ajax\semantic\html\content\HtmlGridRow;
use Ajax\semantic\html\base\constants\Wide;
use Ajax\semantic\html\base\constants\VerticalAlignment;
use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\base\traits\TextAlignmentTrait;
use Ajax\semantic\html\content\HtmlGridCol;

/**
 * Semantic Grid component
 * @see http://semantic-ui.com/collections/grid.html
 * @author jc
 * @version 1.001
 */
class HtmlGrid extends HtmlSemCollection{
	use TextAlignmentTrait;
	private $_createCols;
	private $_colSizing=true;
	private $_implicitRows=false;
	public function __construct( $identifier,$numRows=1,$numCols=NULL,$createCols=true,$implicitRows=false){
		parent::__construct( $identifier, "div","ui grid");
		$this->_implicitRows=$implicitRows;
		$this->_createCols=$createCols;
		if(isset($numCols)){
			//if($this->_createCols){
				$this->_colSizing=false;
			//}
			$this->setWide($numCols);
		}
		$this->setRowsCount($numRows,$numCols);
	}

	public function setWide($wide){
		$wide=Wide::getConstants()["W".$wide];
		$this->addToPropertyCtrl("class", $wide, Wide::getConstants());
		return $this->addToPropertyCtrl("class","column",array("column"));
	}

	public function addRow($colsCount=NULL){
		return $this->addItem($colsCount);
	}

	/**
	 * Create $rowsCount rows
	 * @param int $rowsCount
	 * @param int $colsCount
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setRowsCount($rowsCount,$colsCount=NULL){
		$count=$this->count();
		if($rowsCount<2){
			for($i=$count;$i<$colsCount;$i++){
				$this->addItem(new HtmlGridCol("col-".$this->identifier."-".$i));
			}
		}else{
			if($this->hasOnlyCols($count)){
				$tmpContent=$this->content;
				$item=$this->addItem($colsCount);
				$item->setContent($tmpContent);
				$this->content=array();
				$count=1;
			}
			for($i=$count;$i<$rowsCount;$i++){
				$this->addItem($colsCount);
			}
		}
		return $this;
	}

	protected function hasOnlyCols($count){
		return $count>0 && $this->content[0] instanceof HtmlGridCol;
	}

	public function setColsCount($numCols,$toCreate=true){
		$this->setWide($numCols);
		if($toCreate==true){
			$count=$this->count();
			if($count==0 || $this->hasOnlyCols($count)){
				for($i=$count;$i<$numCols;$i++){
					$this->addItem(new HtmlGridCol("col-".$this->identifier."-".$i));
				}
			}else{
				for($i=0;$i<$count;$i++){
					$this->getItem($i)->setNumCols($numCols);
				}
			}
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
		if($row<2 && $this->hasOnlyCols($this->count()))
			return $this->getItem($col);
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
		return $this->addToPropertyCtrl("class", $value,array("divided"));
	}

	/**
	 * Divides rows into cells
	 * @param boolean $internally true for internal cells
	 * @return \Ajax\semantic\html\collections\HtmlGrid
	 */
	public function setCelled($internally=false){
		$value=($internally===true)?"internally celled":"celled";
		return $this->addToPropertyCtrl("class", $value,array("celled","internally celled"));
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
		return $this->addToPropertyCtrl("class", $value,array("relaxed","very relaxed"));
	}

	public function setVerticalAlignment($value=VerticalAlignment::MIDDLE){
		return $this->addToPropertyCtrl("class", $value." aligned",VerticalAlignment::getConstantValues("aligned"));
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlCollection::createItem()
	 */
	protected function createItem($value){
		if($this->_createCols===false)
			$value=null;
		$item=new HtmlGridRow($this->identifier."-row-".($this->count()+1),$value,$this->_colSizing,$this->_implicitRows);
		return $item;
	}

	public function setValues($values){
		$count=$this->count();
		if($this->_createCols===false){
			for($i=$count;$i<\sizeof($values);$i++){
				$colSize=\sizeof($values[$i]);
				$this->addItem(new HtmlGridRow($this->identifier."-row-".($this->count()+1),$colSize,$this->_colSizing,$this->_implicitRows));
			}
		}
		$count=\min(array($this->count(),\sizeof($values)));
		for($i=0;$i<$count;$i++){
			$this->content[$i]->setValues($values[$i],$this->_createCols===false);
		}
	}

	public function rowCount(){
		return $this->count();
	}

	public function colCount(){
		$result=0;
		$count=$this->count();
		if($count>0){
			if($this->content[0] instanceof HtmlGridCol)
				$result=$count;
			else
				$result=$this->content[0]->count();
		}
		return $result;
	}

	/**
	 * stretch the row contents to take up the entire column height
	 * @return \Ajax\semantic\html\content\HtmlGridRow
	 */
	public function setStretched(){
		return $this->addToProperty("class", "stretched");
	}

}