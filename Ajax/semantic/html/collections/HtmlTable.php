<?php

namespace Ajax\semantic\html\collections;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\content\table\HtmlTableContent;

class HtmlTable extends HtmlSemDoubleElement {
	private $_colCount;
	public function __construct($identifier, $rowCount, $colCount) {
		parent::__construct($identifier, "table", "ui table");
		$this->content=array();
		$this->setRowCount($rowCount, $colCount);
	}

	/**
	 * @param string $key
	 * @return HtmlTableContent
	 */
	private function getPart($key){
		if(\array_key_exists($key, $this->content)===false){
			$this->content[$key]=new HtmlTableContent("",$key);
			if($key!=="tbody"){
				$this->content[$key]->setRowCount(1, $this->_colCount);
			}
		}
		return $this->content[$key];
	}

	public function getBody(){
		return $this->getPart("tbody");
	}

	public function getHeader(){
		return $this->getPart("thead");
	}

	public function getFooter(){
		return $this->getPart("tfoot");
	}

	public function hasPart($key){
		return \array_key_exists($key, $this->content)===true;
	}

	public function setRowCount($rowCount, $colCount) {
		$this->_colCount=$colCount;
		return $this->getBody()->setRowCount($rowCount,$colCount);
	}

	/**
	 * Returns the cell (HtmlTD) at position $row,$col
	 * @param int $row
	 * @param int $col
	 * @return \Ajax\semantic\html\content\HtmlTD
	 */
	public function getCell($row,$col){
		return $this->getBody()->getCell($row,$col);
	}

	public function setValues($values=array()){
		$this->getBody()->setValues($values);
	}
}