<?php
namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\bootstrap\html\content\HtmlGridRow;
use Ajax\bootstrap\html\content\HtmlGridCol;
use Ajax\JsUtils;
use Phalcon\Mvc\View;

/**
 * Composant Twitter Bootstrap Grid system
 * @see http://getbootstrap.com/css/#grid
 * @author jc
 * @version 1.001
 */
class HtmlGridSystem extends HtmlDoubleElement {
	private $rows;
	
	public function __construct($identifier,$numRows=1){
		parent::__construct($identifier,"div");
		$this->setProperty("class", "container");
		$this->rows=array();
		$this->setNumRows($numRows);
	}
	
	/**
	 * @return \Ajax\bootstrap\html\content\HtmlGridRow
	 */
	public function addRow(){
		$row=new HtmlGridRow($this->identifier."-row-".(sizeof($this->rows)+1));
		$this->rows[]=$row;
		return $row;
	}
	
	/**
	 * @param int $index
	 * @return \Ajax\bootstrap\html\content\HtmlGridRow
	 */
	public function getRow($index,$force=true){
		if($index<sizeof($this->rows)){
			$result=$this->rows[$index-1];
		}else if ($force){
			$this->setNumRows($index);
			$result=$this->rows[$index-1];
		}
		return $result;
	}
	
	public function setNumRows($numRows){
		for($i=sizeof($this->rows);$i<$numRows;$i++){
			$this->addRow();
		}
		return $this;
	}
	
	/**
	 * @param int $row
	 * @param int $col
	 * @return HtmlGridCol
	 */
	public function getCell($row,$col,$force=true){
		$row=$this->getRow($row,$force);
		if(isset($row)){
			$col=$row->getCol($col,$force);
		}
		return $col;
	}
	
	/**
	 * @param int $row
	 * @param int $col
	 * @return HtmlGridCol
	 */
	public function getCellAt($row,$col,$force=true){
		$row=$this->getRow($row,$force);
		if(isset($row)){
			$col=$row->getColAt($col,$force);
		}
		return $col;
	}
	
	public function compile(JsUtils $js=NULL, View $view=NULL) {
		foreach ($this->rows as $row){
			$this->addContent($row);
		}
		return parent::compile($js,$view);
	}
}