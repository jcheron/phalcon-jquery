<?php

namespace Ajax\semantic\html\content;

use Ajax\common\html\html5\HtmlCollection;

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
	 * return the col at $index
	 * @param int $index
	 * @return \Ajax\semantic\html\collections\HtmlGridCol
	 */
	public function getCol($index){
		return $this->getItem($index);
	}

	protected function createItem($value){
		$col=new HtmlGridCol($this->identifier."-col-".($this->count()+1),$value);
		return $col;
	}
}