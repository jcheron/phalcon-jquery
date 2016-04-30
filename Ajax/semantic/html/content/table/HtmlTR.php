<?php

namespace Ajax\semantic\html\content\table;

use Ajax\semantic\html\base\HtmlSemCollection;

/**
 *
 * @author jc
 *
 */
class HtmlTR extends HtmlSemCollection {
	private $_tdTagName;
	private $_container;
	private $_row;

	public function __construct($identifier) {
		parent::__construct($identifier, "tr", "");
	}

	public function setColCount($colCount) {
		$count=$this->count();
		for($i=$count; $i < $colCount; $i++) {
			$item=$this->addItem(NULL);
			$item->setTagName($this->_tdTagName);
		}
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Ajax\common\html\HtmlCollection::createItem()
	 */
	protected function createItem($value) {
		$count=$this->count();
		$td=new HtmlTD("", $value, $this->_tdTagName);
		$td->setContainer($this->_container, $this->_row, $count);
		return $td;
	}

	public function setTdTagName($tagName="td") {
		$this->_tdTagName=$tagName;
	}

	/**
	 * Define the container (HtmlTableContent) and the num of the row
	 * @param HtmlTableContent $container
	 * @param int $row
	 */
	public function setContainer($container, $row) {
		$this->_container=$container;
		$this->_row=$row;
	}

	/**
	 * Sets values to the row cols
	 * @param mixed $values
	 */
	public function setValues($values=array()) {
		$count=$this->count();
		if (\is_array($values) === false) {
			$values=\array_fill(0, $count, $values);
		}
		$count=\min(\sizeof($values), $count);
		
		for($i=0; $i < $count; $i++) {
			$cell=$this->content[$i];
			$cell->setValue($values[$i]);
		}
	}

	/**
	 * Removes the col at $index
	 * @param int $index the index of the col to remove
	 * @return \Ajax\semantic\html\content\table\HtmlTR
	 */
	public function delete($index) {
		$this->removeItem($index);
		return $this;
	}

	public function mergeCol($colIndex=0) {
		return $this->getItem($colIndex)->mergeCol();
	}

	public function mergeRow($colIndex=0) {
		return $this->getItem($colIndex)->mergeRow();
	}
}