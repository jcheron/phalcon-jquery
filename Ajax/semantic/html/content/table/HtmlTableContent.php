<?php

namespace Ajax\semantic\html\content\table;

use Ajax\semantic\html\base\HtmlSemCollection;

class HtmlTableContent extends HtmlSemCollection{

	protected $_tdTagNames=["thead"=>"th","tbody"=>"td","tfoot"=>"th"];

	public function __construct( $identifier,$tagName="tbody",$rowCount=NULL,$colCount=NULL){
		parent::__construct( $identifier, $tagName, "");
		if(isset($rowCount) && isset($colCount))
			$this->setRowCount($rowCount, $colCount);
	}

	public function setRowCount($rowCount,$colCount){
		$count=$this->count();
		for($i=$count;$i<$rowCount;$i++){
			$this->addItem($colCount);
		}
		for($i=0;$i<$rowCount;$i++){
			$item=$this->content[$i];
			$item->setTdTagName($this->_tdTagNames[$this->tagName]);
			$this->content[$i]->setColCount($colCount);
		}
		return $this;
	}

	protected function createItem($value){
		$count=$this->count();
		$tr= new HtmlTR("", $value);
		$tr->setContainer($this, $count);
		return $tr;
	}

	/**
	 * Returns the cell (HtmlTD) at position $row,$col
	 * @param int $row
	 * @param int $col
	 * @return \Ajax\semantic\html\content\HtmlTD
	 */
	public function getCell($row,$col){
		$row=$this->getItem($row);
		if(isset($row)){
			$col=$row->getItem($col);
		}
		return $col;
	}

	public function getRow($index){
		return $this->getItem($index);
	}

	public function setCellValue($row,$col,$value=""){
		$cell=$this->getCell($row, $col);
		if(isset($cell)){
			$cell->setValue($value);
		}
		return $this;
	}

	public function setValues($values=array()){
		$count=$this->count();
		if(\is_array($values)===false){
			$values=\array_fill(0, $count, $values);
		}
		$count=\min(\sizeof($values),$count);

		for ($i=0;$i<$count;$i++){
			$row=$this->content[$i];
			$row->setValues($values[$i]);
		}
	}

	public function getRowCount(){
		return $this->count();
	}

	public function getColCount(){
		$result=0;
		if($this->count()>0)
			$result=$this->getItem(0)->getColCount();
		return $result;
	}

	public function delete($rowIndex,$colIndex=NULL){
		if(isset($colIndex)){
			$row=$this->getItem($rowIndex);
			if(isset($row)===true){
				$row->delete($colIndex);
			}
		}else{
			$this->removeItem($rowIndex);
		}
		return $this;
	}

}