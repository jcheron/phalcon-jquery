<?php

namespace Ajax\semantic\html\content\table;

use Ajax\semantic\html\base\HtmlSemDoubleElement;

class HtmlTD extends HtmlSemDoubleElement {
	private $_container;
	private $_row;
	private $_col;
	public function __construct($identifier,$content=NULL,$tagName="td") {
		parent::__construct($identifier, $tagName, "", $content);
	}

	public function setContainer($container,$row,$col){
		$this->_container=$container;
		$this->_row=$row;
		$this->_col=$col;
	}

	public function setValue($value){
		$this->content=$value;
		return $this;
	}

	public function setRowspan($rowspan){
		$to=min($this->_container->count(),$this->_row+$rowspan-1);
		for($i=$to;$i>$this->_row;$i--){
			$this->_container->delete($this->_row+1,$this->_col);
		}
		$this->setProperty("rowspan", $rowspan);
		return $this->_container;
	}

	public function rowMerge(){
		return $this->setRowspan($this->_container->count());
	}

	public function colMerge(){
		return $this->setColspan($this->_container->getRow($this->_row)->count());
	}

	public function setColspan($colspan){
		$to=min($this->_container->getRow($this->_row)->count(),$this->_col+$colspan-1);
		for($i=$to;$i>$this->_col;$i--){
			$this->_container->delete($this->_row,$this->_col+1);
		}
		$this->setProperty("colspan", $colspan);
		return $this->_container;
	}
}