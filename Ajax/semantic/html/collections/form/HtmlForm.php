<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\elements\HtmlHeader;
/**
 * Semantic Form component
 * @see http://semantic-ui.com/collections/form.html
 * @author jc
 * @version 1.001
 */
class HtmlForm extends HtmlSemCollection{

	use FieldsTrait;

	protected $_fields;

	public function __construct( $identifier, $elements=array()){
		parent::__construct( $identifier, "form", "ui form");
		$this->setProperty("name", $this->identifier);
		$this->_fields=array();
		$this->addItems($elements);
	}

	public function addHeader($title,$niveau=1,$dividing=true){
		$header=new HtmlHeader("",$niveau,$title);
		if($dividing)
			$header->setDividing();
		return $this->addItem($header);
	}

	public function addFields($fields,$label=NULL){
		if(\is_array($fields)===false){
			$fields = \func_get_args();
			$end=\end($fields);
			if(\is_string($end)){
				$label=$end;
				\array_pop($fields);
			}
		}
		$this->_fields=\array_merge($this->_fields,$fields);
		$field=new HtmlFormField("", new HtmlFormFields("fields-".$this->identifier."-".$this->count(),$fields),$label);
		return $this->addItem($field);
	}

	public function addItem($item){
		$item=parent::addItem($item);
		if(\is_subclass_of($item, HtmlFormField::class)===true){
			$this->_fields[]=$item;
		}
		return $item;
	}

	public function getField($index){
		if(\is_string($index)){
			$field=$this->getElementById($index, $this->_fields);
		}else{
			$field=$this->_fields[$index];
		}
		return $field;
	}
}