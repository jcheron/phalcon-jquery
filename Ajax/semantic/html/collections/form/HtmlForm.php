<?php

namespace Ajax\semantic\html\collections\form;

use Ajax\semantic\html\base\HtmlSemCollection;
use Ajax\semantic\html\elements\HtmlHeader;
use Ajax\semantic\html\collections\HtmlMessage;
use Ajax\semantic\html\elements\HtmlButton;
use Ajax\semantic\html\base\constants\State;
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
		$this->_states=[State::ERROR,State::SUCCESS,State::WARNING,State::DISABLED];
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
		if(!$fields instanceof HtmlFormFields){
			if(\is_array($fields)===false){
				$fields = \func_get_args();
				$end=\end($fields);
				if(\is_string($end)){
					$label=$end;
					\array_pop($fields);
				}else $label=NULL;
			}
			$this->_fields=\array_merge($this->_fields,$fields);
			$fields=new HtmlFormFields("fields-".$this->identifier."-".$this->count(),$fields);
		}
		if(isset($label))
		 $fields=new HtmlFormField("", $fields,$label);
		$this->addItem($fields);
		return $fields;
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

	/**
	 * automatically divide fields to be equal width
	 * @return \Ajax\semantic\html\collections\form\HtmlForm
	 */
	public function setEqualWidth(){
		return $this->addToProperty("class", "equal width");
	}

	/**
	 * Adds a field (alias for addItem)
	 * @param HtmlFormField $field
	 * @return \Ajax\common\html\HtmlDoubleElement
	 */
	public function addField($field){
		return $this->addItem($field);
	}

	/**
	 * @param string $identifier
	 * @param string $content
	 * @param string $header
	 * @param string $icon
	 * @param string $type
	 * @return \Ajax\semantic\html\collections\HtmlMessage
	 */
	public function addMessage($identifier,$content,$header=NULL,$icon=NULL,$type=NULL){
		$message=new HtmlMessage($identifier,$content);
		if(isset($header))
			$message->addHeader($header);
		if(isset($icon))
			$message->setIcon($icon);
		if(isset($type))
			$message->setStyle($type);
		return $this->addItem($message);
	}

	public function addInputs($inputs,$fieldslabel=null){
		$fields=array();
		foreach ($inputs as $input){
			\extract($input);
			$f=new HtmlFormInput("","");
			$f->fromArray($input);
			$fields[]=$f;
		}
		return $this->addFields($fields,$fieldslabel);
	}

	public function addDropdown($identifier,$items=array(), $label=NULL,$value=NULL,$multiple=false){
		return $this->addItem(new HtmlFormDropdown($identifier,$items,$label,$value,$multiple));
	}

	public function addInput($identifier, $label=NULL,$type="text",$value=NULL,$placeholder=NULL){
		return $this->addItem(new HtmlFormInput($identifier,$label,$type,$value,$placeholder));
	}

	public function addButton($identifier,$value,$cssStyle=NULL,$onClick=NULL){
		return $this->addItem(new HtmlButton($identifier,$value,$cssStyle,$onClick));
	}

	public function addCheckbox($identifier, $label=NULL,$value=NULL,$type=NULL){
		return $this->addItem(new HtmlFormCheckbox($identifier,$label,$value,$type));
	}

	public function setLoading(){
		return $this->addToProperty("class", "loading");
	}

	public function jsState($state){
		return $this->jsDoJquery("addClass",$state);
	}
}