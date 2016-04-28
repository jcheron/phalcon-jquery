<?php

namespace Ajax\semantic\html\collections;

use Ajax\semantic\html\base\HtmlSemDoubleElement;
use Ajax\semantic\html\content\table\HtmlTableContent;
use Ajax\semantic\html\base\constants\Variation;

/**
 * Semantic HTML Table component
 * @author jc
 *
 */
class HtmlTable extends HtmlSemDoubleElement {
	private $_colCount;
	public function __construct($identifier, $rowCount, $colCount) {
		parent::__construct($identifier, "table", "ui table");
		$this->content=array();
		$this->setRowCount($rowCount, $colCount);
		$this->_variations=[Variation::CELLED,Variation::PADDED];
	}

	/**
	 * Returns/create eventually a part of the table corresponding to the $key : thead, tbody or tfoot
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

	/**
	 * Returns/create eventually the body of the table
	 * @return \Ajax\semantic\html\content\table\HtmlTableContent
	 */
	public function getBody(){
		return $this->getPart("tbody");
	}

	/**
	 * Returns/create eventually the header of the table
	 * @return \Ajax\semantic\html\content\table\HtmlTableContent
	 */
	public function getHeader(){
		return $this->getPart("thead");
	}

	/**
	 * Returns/create eventually the footer of the table
	 * @return \Ajax\semantic\html\content\table\HtmlTableContent
	 */
	public function getFooter(){
		return $this->getPart("tfoot");
	}

	/**
	 * Checks if the part corresponding to $key exists
	 * @param string $key
	 * @return boolean
	 */
	public function hasPart($key){
		return \array_key_exists($key, $this->content)===true;
	}

	/**
	 * @param int $rowCount
	 * @param int $colCount
	 * @return \Ajax\semantic\html\content\table\HtmlTableContent
	 */
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
		return $this;
	}

	public function setColValues($colIndex,$values=array()){
		$this->getBody()->setColValues($colIndex,$values);
		return $this;
	}

	public function colCenter($colIndex){
		if($this->hasPart("thead"))
			$this->getHeader()->colCenter($colIndex);
		$this->getBody()->colCenter($colIndex);
		return $this;
	}

	public function setCelled(){
		return $this->addToProperty("class", "celled");
	}
}