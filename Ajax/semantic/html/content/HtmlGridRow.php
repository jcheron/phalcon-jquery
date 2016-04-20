<?php

namespace Ajax\semantic\html\content;

use Ajax\semantic\html\base\constants\Wide;
use Ajax\semantic\html\base\constants\Color;
use Ajax\JsUtils;
use Phalcon\Mvc\View;
use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\base\traits\TextAlignmentTrait;


/**
 * A row for the Semantic Grid component
 * @see http://semantic-ui.com/collections/grid.html
 * @author jc
 * @version 1.001
 */
class HtmlGridRow extends HtmlSemCollection{
	use TextAlignmentTrait;

	private $_colSize;
	private $_implicite=false;
	public function __construct( $identifier,$numCols=NULL,$colSizing=false,$implicite=false){
		parent::__construct( $identifier,"div","row");
		$this->_implicite=$implicite;
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

	public function setNumCols($numCols){
		$count=$this->count();
		for($i=$count;$i<$numCols;$i++){
			$this->addItem(null);
		}
		return $this;
	}

	/**
	 * stretch the row contents to take up the entire column height
	 * @return \Ajax\semantic\html\content\HtmlGridRow
	 */
	public function setStretched(){
		return $this->addToProperty("class", "stretched");
	}

	/**
	 * @param string $color
	 * @return \Ajax\semantic\html\content\HtmlGridRow
	 */
	public function setColor($color){
		return $this->addToPropertyCtrl("class", $color,Color::getConstants());
	}

	public function setValues($values,$force=false){
		$count=$this->count();
		if($force===true){
			for($i=$count;$i<\sizeof($values);$i++){
				$this->addItem(new HtmlGridCol($this->identifier."-col-".($this->count()+1),null));
			}
		}
		$count=\min(array($this->count(),\sizeof($values)));
		for($i=0;$i<$count;$i++){
			$this->content[$i]->setValue($values[$i]);
		}
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlCollection::createItem()
	 */
	protected function createItem($value){
		$col=new HtmlGridCol($this->identifier."-col-".($this->count()+1),$value);
		return $col;
	}

	public function compile(JsUtils $js=NULL,View $view=NULL){
		if($this->_implicite===true){
			$this->_template="%wrapContentBefore%%content%%wrapContentAfter%";
		}
		return parent::compile($js,$view);
	}
}