<?php
namespace Ajax\bootstrap\html\base;
use Ajax\JsUtils;
include_once 'BaseHtml.php';

class HtmlSingleElement extends BaseHtml {

	public function __construct($identifier,$tagName="br") {
		parent::__construct($identifier);
		$this->tagName=$tagName;
		$this->_template="<%tagName% id='%identifier%' %properties%/>";
	}

	public function setClass($classNames){
		$this->setProperty("class", $classNames);
	}

	public function setRole($value){
		$this->setProperty("role", $value);
	}

	public function setTitle($value){
		$this->setProperty("title", $value);
	}
	public function run(JsUtils $js) {
		// TODO Auto-generated method stub
	}

	public function __toString(){
		return $this->compile();
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\BaseHtml::fromArray()
	 */
	public function fromArray($array) {
		$array=parent::fromArray($array);
		foreach ($array as $key=>$value){
			$this->setProperty($key, $value);
		}
		return $array;
	}
	public function setSize($size){}
}