<?php
namespace Ajax\bootstrap\html\phalcon;

use Ajax\bootstrap\html\phalcon\PhBsElement;
use Ajax\bootstrap\html\HtmlInput;
use Phalcon\Forms\Element\Text;
/**
 * @author jc
 *
 */
class PhBsText extends PhBsElement{
	protected $htmlElement;
	public function __construct($name, array $attributes = null) {
		parent::__construct ( $name, $attributes);
		$this->htmlElement=new HtmlInput($name);
	}


	/* (non-PHPdoc)
	 * @see \Phalcon\Forms\Element::setLabel()
	 */
	public function setLabel($label) {
		parent::setLabel($label);
		$this->htmlElement->addLabel($label);
	}

	public function render($attributes=null){
			if(isset($attributes))
				$this->htmlElement->addProperties($attributes);
			$this->htmlElement->setValue($this->getValue());
		return $this->htmlElement->compile();
	}
}