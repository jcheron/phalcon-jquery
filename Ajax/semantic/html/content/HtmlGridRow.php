<?php

namespace Ajax\semantic\html\content;

use Ajax\common\html\HtmlCollection;
use Ajax\semantic\html\base\Wide;
/**
 * A row for the Semantic Grid component
 * @see http://semantic-ui.com/collections/grid.html
 * @author jc
 * @version 1.001
 */
class HtmlGridRow extends HtmlCollection{

	private $_colSize;
	public function __construct( $identifier,$numCols=NULL,$colSizing=false){
		parent::__construct( $identifier,"div");
		$this->setClass("row");
		$width=null;
		if(isset($numCols)){
			$numCols=min(16,$numCols);
			$numCols=max(1,$numCols);
			if($colSizing)
				$width=(int)(16/$numCols);
			else
				$this->_colSize=16/$numCols;
			for ($i=0;$i<$numCols;$i++){
				$this->addItem($width);
			}
		}
	}

	/**
	 * Defines the row width
	 * @param int $width
	 * @return \Ajax\semantic\html\content\HtmlGridRow
	 */
	public function setWidth($width){
		if(\is_int($width)){
			$width=Wide::getConstants()["W".$width];
		}
		$this->addToPropertyCtrl("class", $width, Wide::getConstants());
		return $this->addToPropertyCtrl("class", "column",array("column"));
	}

	/**
	 * return the col at $index
	 * @param int $index
	 * @return \Ajax\semantic\html\collections\HtmlGridCol
	 */
	public function getCol($index){
		return $this->getItem($index);
	}

	/**
	 * stretch the row contents to take up the entire column height
	 * @return \Ajax\semantic\html\content\HtmlGridRow
	 */
	public function setStretched(){
		return $this->addToProperty("class", "stretched");
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlCollection::createItem()
	 */
	protected function createItem($value){
		$col=new HtmlGridCol($this->identifier."-col-".($this->count()+1),$value);
		return $col;
	}
}